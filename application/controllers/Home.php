<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
               parent::__construct();
               $this->load->model('Outletdetails_model');
        }


	public function index()
	{
		$data=array();
		$data['title']="Home";
		$data['query'] = $this->db->get('outletdetails');
		$this->load->view('header',$data);
		$this->load->view('topbar',$data);
		$this->load->view('sidebar');
		$this->load->view('loggedin_view',$data);
		$this->load->view('footer');
	}

	public function delete($id)
	{
		$this->Outletdetails_model->delete($id);
		redirect('home');
	}

	public function edit($id)
	{
		$data=array();
		$data['title']="Edit-Outlet";
		$this->db->where('id',$id);
        	$query = $this->db->get('outletdetails');
		$result = $query->result();
		$data['query'] = $result[0];
		//print_r($data['query']);
		$this->load->view('header',$data);
		$this->load->view('topbar');
		$this->load->view('sidebar');
		$this->load->view('edit_view',$data);
		$this->load->view('footer');
	}

	public function add()
	{
		$data=array();
		$data['title']="Add-Outlet";
		$this->load->view('header',$data);
		$this->load->view('topbar');
		$this->load->view('sidebar');
		$this->load->view('add_view',$data);
		$this->load->view('footer');
	}

	public function update()
	{
		$formdata= array();
		$formdata['id'] = $this->input->post('id');
                $formdata['name'] = $this->input->post('name');
                $formdata['mgr_name'] = $this->input->post('mgr_name');
		$formdata['mgr_phno'] = $this->input->post('mgr_phno');
		$formdata['lat'] = $this->input->post('lat');
		$formdata['lon'] = $this->input->post('lon');
		$formdata['rad'] = $this->input->post('area_covered');
                $this->Outletdetails_model->update($formdata);
		redirect('home');

	}

	public function view($id)
	{
		$data=array();
		$data['title']="View-Outlet";
		$this->db->where('id',$id);
        	$query = $this->db->get('outletdetails');
		$result = $query->result();
		$data['query'] = $result[0];
		//print_r($data['query']);
		$this->load->view('header',$data);
		$this->load->view('topbar');
		$this->load->view('sidebar');
		$this->load->view('show_view',$data);
		$this->load->view('footer');
	}


	public function convert($id)
	{
		require 'pdfcrowd.php';
		$this->db->where('id',$id);
        	$query = $this->db->get('outletdetails');
		$result = $query->result();
		$row = $result[0];
		try
		{   
		    // create an API client instance
		    $client = new Pdfcrowd("redefiningcuriosity", "c28a2bccac313d6d2c6c4739ed9846d8");

		    // convert a web page and store the generated PDF into a $pdf variable
		    $html="<!DOCTYPE html>
<html>
<head>
<title>PDF</title>

<link href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css\" rel=\"stylesheet\">
<link href=\"http://localhost/petoo/assets/css/styles.css\" rel=\"stylesheet\">

<!--[if lt IE 9]>
<script src=\"js/html5shiv.js\"></script>
<script src=\"js/respond.min.js\"></script>
<![endif]-->
<style>
#map-canvas {
    height: 500px;
    width:  500px;
    margin: 0;
    padding: 0;
    margin-top: 0px;
}
</style>
</head>
<body>
<div class=\"col-sm-9 col-sm-offset-2 col-lg-10 col-lg-offset-1 main\">			
		<div class=\"row\">
			<img src=\"http://d39in59pr3ya79.cloudfront.net/n/images/petoo-footer-logo.png\"><br><br>
		</div><!--/.row-->
		<div class=\"row\">
			<div class=\"col-lg-12\">
				<div class=\"panel panel-default\">
					<div class=\"panel-body\">
						<div class=\"col-md-4\">
							<form role=\"form\">
								<div class=\"form-group\">
									<label>Outlet Name: </label>
									<input class=\"form-control\" id=\"name\" name=\"name\" value=\"".$row->name."\" required>
								</div>
								<div class=\"form-group\">
									<label>Manager Name: </label>
									<input class=\"form-control\" id=\"name\" name=\"name\" value=\"".$row->mgr_name."\" required>
								</div>
								<div class=\"form-group\">
									<label>Manager phone: </label><input class=\"form-control\" id=\"name\" name=\"name\" value=\"".$row->mgr_phno."\" required>
								</div>
								<div class=\"form-group\">
									<label>Latitude: </label><input class=\"form-control\" id=\"name\" name=\"name\" value=\"".$row->lat."\" required>
								</div>
								<div class=\"form-group\">
									<label>Longitude: </label><input class=\"form-control\" id=\"name\" name=\"name\" value=\"".$row->lon."\" required>
								</div>
								<div class=\"form-group\">
									<label>Area Covered: </label><input class=\"form-control\" id=\"name\" name=\"name\" value=\"".$row->area_covered."\" required>
								</div>
							</form>
						</div>
						<div class=\"col-md-8\">
							<img src=\"http://maps.google.com/maps/api/staticmap?center=".$row->lat.",".$row->lon."&zoom=14&size=350x350&sensor=false&markers=color:red|".$row->lat.",".$row->lon."\">
						</div>
					</div>
					</div>
				</div>
			</div>
			
		</div>

</body>

</html>";
			//echo $html;
			$pdf = $client->convertHtml($html);
		    // set HTTP response headers
		    header("Content-Type: application/pdf");
		    header("Cache-Control: max-age=0");
		    header("Accept-Ranges: none");
		    header("Content-Disposition: attachment; filename=\"google_com.pdf\"");

		    // send the generated PDF 
		    echo $pdf;
		}
		catch(PdfcrowdException $why)
		{
		    echo "Pdfcrowd Error: " . $why;
		}
	}
}
