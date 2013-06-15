<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/* | ====================================================================================================
 * | Codeigniter MySQL Dump Library
 * | ====================================================================================================
 * | Copyright (C) : 2013. Nurimansyah Rifwan
 * | Email: nurimansyah.rifwan@gmail.com
 * | Kaskus ID: ashenkk
 * | ====================================================================================================
 * | DISCLAIMER
 * | ====================================================================================================
 * | THIS WORK IS LICENSED UNDER THE CREATIVE COMMONS ATTRIBUTION-SHAREALIKE 3.0 UNPORTED LICENSE. 
 * | TO VIEW A COPY OF THIS LICENSE, VISIT http://creativecommons.org/licenses/by-sa/3.0/.
 * | ====================================================================================================
*/

// Pertama kita set timelimit agar tidak timeout saat eksekusi
set_time_limit(0);

class mysqldump {
	// Atribut Global
	var $versi_dump = '0.1'; // Versi Library MySQL Dump	
	var $CI = NULL; // Inisialisasi variabel CI
	
	// Konstruktor
	public function __construct()
	{
		// Instansi CI
		$this->CI =& get_instance();
	}
	
	// Fungsi dumping database
	public function do_dump()
	{
		// Set Header
		header('Content-type: application/sql');
		header('Content-Disposition: attachment; filename="backup_'.date("dmY_His").'.sql"');
		
		// Set Version
		$string = '/*
| MySQL Dump Versi - '.$this->versi_dump.'
| Copyright (C): nurimansyah.rifwan@gmail.com
| Kaskus ID: ashenkk
*/

';
		print($string);
		
		// Tampilkan seluruh nama table
		$result = $this->CI->db->list_tables();
		
		// Looping
		if($result):
			foreach($result as $i => $v):
				// Ambil Data Table Structure
				$this->get_structure($v);
				// Insert Data
				$this->table_data($v);
			endforeach;
		endif;
		$result->free_result();
		
		// Return
		return true;
	}
	
	// Fungsi Insert Table data
	private function table_data($table = NULL)
	{
		// Pilih Table
		$result = $this->CI->db->get($table);
		if($result)
		{
			// Ambil Banyak Data dan Banyak Field
			$banyak_data = $result->num_rows();
			$banyak_field = $result->num_fields();
			
			// Jika ada data
			if($banyak_data > 0)
			{
				print("/* Dumping data untuk tabel `".$table."` */\n");	
				// Ambil tipe field
				$tipe_field = array();
				$nama_field = array();
				$meta = $this->CI->db->field_data($table);
				foreach($meta as $k => $v):
					array_push($tipe_field, $v->type);
					array_push($nama_field, $v->name);
				endforeach;
				
				// Insert SQL
				print("INSERT INTO `".$table."` VALUES\n");
				$j = 0;
				foreach($result->result_array() as $l):
					print("(");
					$i = 0;
					foreach($nama_field as $i => $v):
						if(is_null($l[$v])):
							print("NULL");
						else:
							switch($tipe_field[$i]):
								case 'int':
								case 'float':
									print($l[$v]);
								break;
								case 'string':
								case 'varchar':
								case 'date':
								case 'datetime':
								case 'enum':
								case 'text':
								case 'blob':
									print("'".mysql_real_escape_string($l[$v])."'");
								break;
							endswitch;
						endif;
						$i++;
						if($i < $banyak_field) print(', ');
						else print(')');
					endforeach;
				$j++;
				if($j < $banyak_data) print(',
');
				else print(';
');
				endforeach;
			}
		}
	}
	
	// Fungsi Ambil Data Table Structure
	private function get_structure($table = NULL)
	{
		$string = '

/* Struktur Table untuk table `'.$table.'` */';	
		$string .= "\n\nDROP TABLE IF EXISTS `".$table."`;\n\n";
		// Buat Table
		$sql = "SHOW CREATE TABLE `".$table."`; ";
		$result = $this->CI->db->query($sql)->row_array();
		
		// Looping
		if($result):
			$string .= $result['Create Table'].";\n\n";
		endif;
		print($string);
	}
}