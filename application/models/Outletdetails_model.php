<?php

class Outletdetails_model extends CI_Model
{
    
   function __construct() {
        parent::__construct();
    }

   function display() {
	$data['query'] =   $this->db->query("SELECT * FROM outletdetails ");
   }

   function update($formdata) {
	if($formdata['id']!=NULL)
	{
		$dataarray = array(
		       'name' => $formdata['name'],
		       'mgr_name' => $formdata['mgr_name'],
			'mgr_phno' => $formdata['mgr_phno'],
			'lat' => $formdata['lat'],
			'lon' => $formdata['lon'],
			'area_covered' => $formdata['rad']
		    );

        	$this->db->where('id', $formdata['id']);
        	$this->db->update('outletdetails', $dataarray); 
	}
	else
	{
		$this->db->set('name', $formdata['name']);
		$this->db->set('mgr_name',$formdata['mgr_name']);
		$this->db->set('mgr_phno',$formdata['mgr_phno']);
		$this->db->set('lat',$formdata['lat']);
		$this->db->set('lon',$formdata['lon']);
		$this->db->set('area_covered',$formdata['rad']);
		$this->db->insert('outletdetails');
  	}

	if($this->db->affected_rows()>0){
            return TRUE;
        }
        else{
            return FALSE;
        }
 }

   function delete($id) {
	if($this->db->delete('outletdetails',  array('id'=>$id))){
            	return TRUE;
            }
            else{
               return FALSE;
            }
   }
}
?>
