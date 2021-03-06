<?php
class m_undangan extends CI_Model{
	
public function getID()
    {
$q = $this->db->query("SELECT MAX(RIGHT(id,4)) AS kd_max FROM tb_calon WHERE DATE(tanggal)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('dmy').$kd;		
    }
	function undangan_list(){
		$hasil=$this->db->query("SELECT * FROM tb_calon");
		return $hasil->result();
	}

	function simpan_undangan($id,$ncp,$ncw,$icp,$icw,$acp,$acw){
		$hasil=$this->db->query("INSERT INTO tb_calon (id,ncp,ncw,icp,icw,acp,acw)VALUES('$id','$ncp','$ncw','$icp','$icw','$acp','$acw')");
		return $hasil;
	}

	function get_undangan_by_kode($id){
		$hsl=$this->db->query("SELECT * FROM tb_calon WHERE id='$id'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'ncp' => $data->ncp,
					'ncw' => $data->ncw,
					'icp' => $data->icp,
					'icw' => $data->icw,
					'acp' => $data->acp,
					'acw' => $data->acw,
					);
			}
		}
		return $hasil;
	}

	function update_undangan($kobar,$nabar,$harga){
		$hasil=$this->db->query("UPDATE tb_calon SET undangan_nama='$nabar',undangan_harga='$harga' WHERE undangan_kode='$kobar'");
		return $hasil;
	}

	function hapus_undangan($kobar){
		$hasil=$this->db->query("DELETE FROM tb_calon WHERE undangan_kode='$kobar'");
		return $hasil;
	}
	
}