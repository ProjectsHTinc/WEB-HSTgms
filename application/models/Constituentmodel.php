<?php
Class Constituentmodel extends CI_Model
{

	public function __construct()
	{

		parent::__construct();
		$this->load->model('smsmodel');
	}

####################  Constituent member ####################

	function create_constituent_member($constituency_id,$paguthi_id,$office_id,$ward_id,$booth_id,$full_name,$father_husband_name,$guardian_name,$mobile_no,$whatsapp_no,$whatsapp_broadcast,$dob,$door_no,$address,$pin_code,$religion_id,$email_id,$gender,$voter_id_status,$voter_id_no,$aadhaar_status,$aadhaar_no,$party_member_status,$vote_type,$serial_no,$filename,$question_id,$question_response,$interaction_section,$voter_status,$user_id){
		// $select="SELECT * FROM constituent where serial_no='$serial_no'";
		// $res_select   = $this->db->query($select);
		// if($res_select->num_rows()==0){
		if($aadhaar_status=='N'){
			$aadhar_id_no=' ';
		}else{
				$aadhar_id_no=$aadhaar_no;
		}
		if($voter_id_status=='N'){
			$voter_no=' ';
		}else{
			$voter_no=$voter_id_no;
		}
		$query="INSERT INTO constituent (constituency_id,paguthi_id,office_id,ward_id,booth_id,full_name,father_husband_name,guardian_name,mobile_no,whatsapp_no,whatsapp_broadcast,dob,door_no,address,pin_code,religion_id,email_id,gender,voter_id_status,voter_id_no,aadhaar_status,aadhaar_no,party_member_status,volunteer_status,serial_no,profile_pic,status,voter_status,created_by,created_at,updated_at,updated_by) VALUES ('$constituency_id','$paguthi_id','$office_id','$ward_id','$booth_id','$full_name','$father_husband_name','$guardian_name','$mobile_no','$whatsapp_no','$whatsapp_broadcast','$dob','$door_no','$address','$pin_code','$religion_id','$email_id','$gender','$voter_id_status','$voter_no','$aadhaar_status','$aadhar_id_no','$party_member_status','$vote_type','$serial_no','$filename','ACTIVE','$voter_status','$user_id',NOW(),'$user_id',NOW())";
		$result=$this->db->query($query);
		 $last_id=$this->db->insert_id();

		 if($interaction_section=='Y'){
			 $count_question=count($question_id);
			for($i=0;$i<$count_question;$i++){
				$insert_interaction="INSERT INTO interaction_history(constituent_id,question_id,question_response,status,created_at,created_by) VALUES('$last_id','$question_id[$i]','$question_response[$i]','Active',NOW(),'$user_id')";
				$res_interaction   = $this->db->query($insert_interaction);
			}
		 }
		if($result){
			$data=array("status"=>"success","msg"=>"constituent created Successfully!","class"=>"alert alert-success");
		}else{
			$data=array("status"=>"error","msg"=>"Something went wrong","class"=>"alert alert-danger");
		}

	// }else{
	// 	$data=array("status"=>"error","msg"=>"Already exists!.","class"=>"alert alert-danger");
	// }
	return $data;
	}


			function update_constituent_member($constituency_id,$paguthi_id,$office_id,$ward_id,$booth_id,$full_name,$father_husband_name,$guardian_name,$mobile_no,$whatsapp_no,$whatsapp_broadcast,$dob,$door_no,$address,$pin_code,$religion_id,$email_id,$gender,$voter_id_status,$voter_id_no,$aadhaar_status,$aadhaar_no,$party_member_status,$vote_type,$serial_no,$filename,$status,$user_id,$voter_status,$constituent_id){
				if($aadhaar_status=='N'){
					$aadhar_id_no=' ';
				}else{
						$aadhar_id_no=$aadhaar_no;
				}
				if($voter_id_status=='N'){
					$voter_no=' ';
				}else{
					$voter_no=$voter_id_no;
				}
				if($whatsapp_no==''){
					$whatsapp_broadcast='NO';
				}else{
					$whatsapp_broadcast='YES';
				}
				$id=base64_decode($constituent_id)/98765;
				$update="UPDATE constituent SET constituency_id='$constituency_id',paguthi_id='$paguthi_id',office_id='$office_id',ward_id='$ward_id',booth_id='$booth_id',full_name='$full_name',father_husband_name='$father_husband_name',guardian_name='$guardian_name',mobile_no='$mobile_no',whatsapp_no='$whatsapp_no',whatsapp_broadcast='$whatsapp_broadcast',dob='$dob',door_no='$door_no',address='$address',pin_code='$pin_code',religion_id='$religion_id',email_id='$email_id',gender='$gender',voter_id_status='$voter_id_status',voter_id_no='$voter_no',aadhaar_status='$aadhaar_status',aadhaar_no='$aadhar_id_no',party_member_status='$party_member_status',volunteer_status='$vote_type',serial_no='$serial_no',profile_pic='$filename',status='$status',updated_at=NOW(),updated_by='$user_id',voter_status='$voter_status' where id='$id'";

					$result=$this->db->query($update);
					if($result){
						$data=array("status"=>"success","msg"=>"constituent updated Successfully!!","class"=>"alert alert-success");
					}else{
						$data=array("status"=>"error","msg"=>"Something went wrong!","class"=>"alert alert-danger");
					}
					return $data;



			}



			function checkserialno($serial_no){
				$select="SELECT * FROM constituent Where serial_no='$serial_no'";
					$result=$this->db->query($select);
					if($result->num_rows()>0){
						echo "false";
						}else{
							echo "true";
					}
			}

			function checkvoter_id_no($voter_id_no){
				$select="SELECT * FROM constituent Where voter_id_no='$voter_id_no'";
					$result=$this->db->query($select);
					if($result->num_rows()>0){
						echo "false";
						}else{
							echo "true";
					}
			}

			function checkaadhaar_no($aadhaar_no){
				$select="SELECT * FROM constituent Where aadhaar_no='$aadhaar_no'";
					$result=$this->db->query($select);
					if($result->num_rows()>0){
						echo "false";
						}else{
							echo "true";
					}
			}

			function checkserialnoexist($constituent_id,$serial_no){
				$select="SELECT * FROM constituent Where serial_no='$serial_no' and id!='$constituent_id'";
					$result=$this->db->query($select);
					if($result->num_rows()>0){
						echo "false";
						}else{
							echo "true";
					}
			}

			function checkvoter_id_noexist($constituent_id,$voter_id_no){
				$select="SELECT * FROM constituent Where voter_id_no='$voter_id_no' and id!='$constituent_id'";
					$result=$this->db->query($select);
					if($result->num_rows()>0){
						echo "false";
						}else{
							echo "true";
					}
			}

			function checkaadhaar_noexist($constituent_id,$aadhaar_no){
				$select="SELECT * FROM constituent Where aadhaar_no='$aadhaar_no' and id!='$constituent_id'";
					$result=$this->db->query($select);
					if($result->num_rows()>0){
						echo "false";
						}else{
							echo "true";
					}
			}

			function get_recent_constituent_member_list(){
				$query="SELECT IFNULL(ih.constituent_id,'0') as interaction_status,IFNULL(pd.constituent_id,'0') as plant_status,c.*,p.paguthi_name FROM constituent  as c left join paguthi  as p on p.id=c.paguthi_id
				left join interaction_history as ih on c.id=ih.constituent_id
				left join plant_donation as pd on pd.constituent_id=c.id group by c.id order by c.id desc LIMIT 1000";
				// $query="SELECT * FROM constituent limit 1000";
				$result=$this->db->query($query);
				return $result->result();
			}

			function get_constituent_member_edit($constituent_id){
				$id=base64_decode($constituent_id)/98765;
				$query="SELECT c.*,p.paguthi_name FROM constituent  as c left join paguthi  as p on p.id=c.paguthi_id where c.id='$id'";
				$result=$this->db->query($query);
				return $result->result();
			}




			function get_books($limit, $start, $st = NULL)
	{
			if ($st == "NIL") $st = "";
			// $sql = "select * from constituent where full_name like '%$st%' limit " . $start . ", " . $limit;
		 	$sql="SELECT IFNULL(ih.constituent_id,'0') as interaction_status,IFNULL(pd.constituent_id,'0') as plant_status,c.*,p.paguthi_name FROM constituent  as c left join paguthi  as p on p.id=c.paguthi_id
			left join interaction_history as ih on c.id=ih.constituent_id
			left join plant_donation as pd on pd.constituent_id=c.id where (c.full_name like '%$st%' or c.voter_id_no like '%$st%') group by c.id order by c.id desc limit $start, $limit";

			$query = $this->db->query($sql);
			return $query->result();
	}

	function get_books_count($st = NULL)
	{
			if ($st == "NIL") $st = "";
			$sql = "select * from constituent where full_name like '%$st%'";
			$query = $this->db->query($sql);
			return $query->num_rows();
	}

	 function record_count() {
        return $this->db->count_all("constituent");
    }

  function fetch_data($limit, $start) {
  		$query="SELECT IFNULL(ih.constituent_id,'0') as interaction_status,IFNULL(pd.constituent_id,'0') as plant_status,c.*,p.paguthi_name FROM constituent  as c left join paguthi  as p on p.id=c.paguthi_id
			left join interaction_history as ih on c.id=ih.constituent_id
			left join plant_donation as pd on pd.constituent_id=c.id group by c.id order by c.id desc limit $start, $limit";
			$query = $this->db->query($query);
  			if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

   }

	 function search_member($limit, $start,$search){

		 $query="SELECT IFNULL(ih.constituent_id,'0') as interaction_status,IFNULL(pd.constituent_id,'0') as plant_status,c.*,p.paguthi_name FROM constituent  as c left join paguthi  as p on p.id=c.paguthi_id
		 left join interaction_history as ih on c.id=ih.constituent_id
		 left join plant_donation as pd on pd.constituent_id=c.id where (c.full_name like '%$search%' or c.voter_id_no like '%$search%' or c.mobile_no like '%$search%') group by c.id order by c.id desc limit $start, $limit";
		 $query = $this->db->query($query);
			 if ($query->num_rows() > 0) {
					 foreach ($query->result() as $row) {
							 $data[] = $row;
					 }
					 return $data;
			 }
			 return false;
	 }



####################  Constituent member ####################


################## documents upload ############################

			function get_list_document($constituent_id){
					$id=base64_decode($constituent_id)/98765;
					$query="SELECT * FROM grievance_documents where constituent_id='$id' and status='ACTIVE' order by id desc";
					$result=$this->db->query($query);
					return $result->result();
			}
			function constituent_document_upload($constituent_id,$doc_name,$filename,$user_id){
					$id=base64_decode($constituent_id)/98765;
					$insert="INSERT INTO grievance_documents(constituent_id,doc_name,doc_file_name,status,created_by,created_at,updated_by,updated_at) VALUES ('$id','$doc_name','$filename','ACTIVE','$user_id',NOW(),'$user_id',NOW())";
						$result=$this->db->query($insert);
						if($result){
							$data=array("status"=>"success","msg"=>"$doc_name Document uploaded Successfully!","class"=>"alert alert-success");
						}else{
							$data=array("status"=>"error","msg"=>"Something went wrong","class"=>"alert alert-danger");
						}
						return $data;

			}

			function delete_document($d_id,$user_id){
					$update="UPDATE grievance_documents SET status='INACTIVE',updated_at=NOW(),updated_by='$user_id' where id='$d_id'";
					$result=$this->db->query($update);
				if($result){
					echo "success";
				}else{
						echo "failure";
				}
				// return $data;
			}
################## documents upload ############################


################## Interaction response ##############


	function save_interaction_response($constituent_id,$question_id,$question_response,$user_id){

			$id=base64_decode($constituent_id)/98765;

			$delete="DELETE FROM interaction_history where constituent_id='$id'";
			$res=	$this->db->query($delete);

			$count_question=count($question_id);
	 		for($i=0;$i<$count_question;$i++){
				 $insert_interaction="INSERT INTO interaction_history(constituent_id,question_id,question_response,status,created_at,created_by,updated_at,updated_by) VALUES('$id','$question_id[$i]','$question_response[$i]','ACTIVE',NOW(),'$user_id',NOW(),'$user_id')";
				 $res_interaction   = $this->db->query($insert_interaction);
			 }

		 if($res_interaction){
			 $data=array("status"=>"success","msg"=>"interaction saved Successfully!","class"=>"alert alert-success");
		 }else{
			 $data=array("status"=>"error","msg"=>"Something went wrong","class"=>"alert alert-danger");
		 }
		 return $data;
	}

		function get_interaction_response_edit($constituent_id){
			$id=base64_decode($constituent_id)/98765;
			$query="SELECT * FROM interaction_history where constituent_id='$id' order by question_id desc";
			$result=$this->db->query($query);
			return $result->result();
		}

################## Interaction response ##############

################## plant donation ##############

	function plant_save($constituent_id,$name_of_plant,$no_of_plant,$user_id){
		$select="SELECT * FROM plant_donation where constituent_id='$constituent_id'";
		$res_select   = $this->db->query($select);
		if($res_select->num_rows()==0){
			$insert_interaction="INSERT INTO plant_donation(constituent_id,name_of_plant,no_of_plant,status,created_at,created_by) VALUES('$constituent_id','$name_of_plant','$no_of_plant','ACTIVE',NOW(),'$user_id')";
			$result   = $this->db->query($insert_interaction);
			if($result){
					$data=array("status"=>"success","msg"=>"Plant  donation saved Successfully!","class"=>"alert alert-success");
				}else{
					$data=array("status"=>"error","msg"=>"Something went wrong","class"=>"alert alert-danger");
				}
		}else{
			$update="UPDATE plant_donation SET name_of_plant='$name_of_plant',no_of_plant='$no_of_plant',updated_at=NOW(),updated_by='$user_id' where constituent_id='$constituent_id'";
			$result   = $this->db->query($update);
			if($result){
					$data=array("status"=>"success","msg"=>"Plant  donation saved Successfully!","class"=>"alert alert-success");
				}else{
					$data=array("status"=>"error","msg"=>"Something went wrong","class"=>"alert alert-danger");
				}
		}

			return $data;
	}


	function get_plant_donation($constituent_id,$user_id){
		$select="SELECT * FROM plant_donation where constituent_id='$constituent_id'";
		$res_select   = $this->db->query($select);
		if($res_select->num_rows()==0){
 		 $data=array("status"=>"error");
	 	 }else{
	 			 $data=array("status"=>"success","res"=>$res_select->result());
	 	 }
	 	 return $data;


	}
################## plant donation ##############

################## Meeting request ##############

	function view_meeting_request($constituent_id,$user_id){
		//$select="SELECT * FROM meeting_request where constituent_id='$constituent_id' order by id desc";

		$select="SELECT *, DATE_FORMAT(`meeting_date`, '%d-%m-%Y') AS disp_date, DATE_FORMAT(`updated_at`, '%d-%m-%Y %h:%i:%s') AS disp_updated_date FROM meeting_request where constituent_id='$constituent_id' ORDER BY id DESC";

		$res_select   = $this->db->query($select);
		if($res_select->num_rows()==0){
		 $data=array("status"=>"error");
		 }else{
				 $data=array("status"=>"success","res"=>$res_select->result());
		 }
		 return $data;
	}

	function edit_meeting_request($meeting_id,$user_id){
		$select="SELECT *,DATE_FORMAT(`meeting_date`, '%d-%m-%Y') AS disp_date FROM meeting_request where id='$meeting_id'";
		$res_select   = $this->db->query($select);
		if($res_select->num_rows()==0){
		 $data=array("status"=>"error");
		 }else{
				 $data=array("status"=>"success","res"=>$res_select->result());
		 }
		 return $data;
	}


	function edit_video_constituent($v_id,$user_id){
		$select="SELECT * FROM constituent_video where id='$v_id'";
		$res_select   = $this->db->query($select);
		if($res_select->num_rows()==0){
		 $data=array("status"=>"error");
		 }else{
				 $data=array("status"=>"success","res"=>$res_select->result());
		 }
		 return $data;
	}


	function update_video_link($video_link_id,$video_title,$video_link,$user_id){
		$query="UPDATE constituent_video SET video_title='$video_title',video_link='$video_link',updated_at=NOW(),updated_by='$user_id' where id='$video_link_id'";
		$result   = $this->db->query($query);
		if($result){
				$data=array("status"=>"success","msg"=>"Video link updated Successfully!","class"=>"alert alert-success");
			}else{
				$data=array("status"=>"error","msg"=>"Something went wrong","class"=>"alert alert-danger");
			}
			 return $data;
	}


	function save_meeting_request($constituent_id,$meeting_title,$meeting_detail,$meeting_date,$meeting_status,$user_id){
		$insert="INSERT INTO meeting_request(constituent_id,meeting_title,meeting_detail,meeting_date,meeting_status,created_at,created_by,updated_at,updated_by) VALUES('$constituent_id','$meeting_title','$meeting_detail','$meeting_date','$meeting_status',NOW(),'$user_id',NOW(),'$user_id')";
		$result   = $this->db->query($insert);
		if($result){
				$data=array("status"=>"success","msg"=>"meeting request saved Successfully!","class"=>"alert alert-success");
			}else{
				$data=array("status"=>"error","msg"=>"Something went wrong","class"=>"alert alert-danger");
			}
			 return $data;
	}


	function update_meeting_request($meeting_id,$meeting_title,$meeting_detail,$meeting_date,$meeting_status,$user_id){
		$query="UPDATE meeting_request SET meeting_title='$meeting_title',meeting_detail='$meeting_detail',meeting_date='$meeting_date',meeting_status='$meeting_status',updated_at=NOW(),updated_by='$user_id' where id='$meeting_id'";
		$result   = $this->db->query($query);
		if($result){
				$data=array("status"=>"success","msg"=>"meeting request updated Successfully!","class"=>"alert alert-success");
			}else{
				$data=array("status"=>"error","msg"=>"Something went wrong","class"=>"alert alert-danger");
			}
			 return $data;
	}

################## Meeting request ##############


################## Grievance module ##############

		function get_petition_no($paguthi_id,$grievance_type,$user_id){
			$selct_paguthi="SELECT * FROM paguthi where id ='$paguthi_id'";
			$re_paguth=$this->db->query($selct_paguthi);
			foreach($re_paguth->result() as $rows_paguthi){}
				$paguthi_short_name=$rows_paguthi->paguthi_short_name;
				$select="SELECT * FROM grievance where grievance_type='$grievance_type' order by id desc LIMIT 1";
					$res=$this->db->query($select);
					if($res->num_rows()==0){
						$next_id='001';
					}else{
						foreach($res->result() as $rows_id){}
							$next_id=$rows_id->id+1;
					}
				if($grievance_type=='P'){

					$petition_code=$paguthi_short_name."PT".$next_id;
				}else{
						$petition_code=$paguthi_short_name."EQ".$next_id;
				}

				if($petition_code){
						$data_peti=array("status"=>"success",'petition_code'=>$petition_code);

				 }else{
					 $data_peti=array("status"=>"error");
				 }


				 $query_1="SELECT * FROM office WHERE status='ACTIVE' and paguthi_id='$paguthi_id' order by id desc";
				 $result_1=$this->db->query($query_1);
					if($result_1->num_rows()==0){
						$data_office=array("status"=>"error");
					}else{
						 $data_office=array("status"=>"success","res_office"=>$result_1->result());
					}

					$data=array("status"=>"success","pet_eny_no"=>$data_peti,"office_data"=>$data_office);
				return $data;

		}


		function save_grievance_data($constituent_id,$constituency_id,$paguthi_id,$office_id,$seeker_id,$grievance_id,$sub_category_id,$grievance_type,$petition_enquiry_no,$description,$grievance_date,$doc_name,$filename,$reference_note,$user_id){
			$gr_date=date('Y-m-d');
			$check="SELECT * FROM grievance WHERE petition_enquiry_no='$petition_enquiry_no'";
			$res_check=$this->db->query($check);
			if($res_check->num_rows()==0){
		 $repeat_check="SELECT * FROM grievance where constituent_id='$constituent_id'";
				$res_repeat=$this->db->query($repeat_check);
				if($res_repeat->num_rows()==0){
					$repeated_status='N';
				}else{
					$repeated_status='R';
				}

				$insert="INSERT INTO grievance (grievance_type,constituent_id,paguthi_id,office_id,petition_enquiry_no,grievance_date,seeker_type_id,grievance_type_id,sub_category_id,reference_note,description,repeated_status,enquiry_status,status,created_by,created_at,updated_by,updated_at) VALUES('$grievance_type','$constituent_id','$paguthi_id','$office_id','$petition_enquiry_no','$gr_date','$seeker_id','$grievance_id','$sub_category_id','$reference_note','$description','$repeated_status','$grievance_type','PENDING','$user_id',NOW(),'$user_id',NOW())";
				$res=$this->db->query($insert);
				$last_id=$this->db->insert_id();
				if(empty($filename)){

				}else{
					$insert_doc="INSERT INTO grievance_documents(constituent_id,grievance_id,doc_name,doc_file_name,status,created_by,created_at,updated_by,updated_at) VALUES ('$constituent_id','$last_id','$doc_name','$filename','ACTIVE','$user_id',NOW(),'$user_id',NOW())";
						$result=$this->db->query($insert_doc);
						if($result){
								$data=array("status"=>"success","msg"=>"Grievance added Successfully!","class"=>"alert alert-success");
							}else{
								$data=array("status"=>"error","msg"=>"Something went wrong","class"=>"alert alert-danger");
							}
				}
					$data=array("status"=>"success","msg"=>"Grievance added Successfully!","class"=>"alert alert-success");
			}else{
				$data=array("status"=>"error","msg"=>"Petition already exists","class"=>"alert alert-danger");
			}
			return $data;


		}



		function get_all_grievance(){
			$query="SELECT g.*,c.full_name,c.address,c.door_no,c.pin_code,p.paguthi_name,st.seeker_info,gt.grievance_name,gsc.sub_category_name FROM grievance as g
			left join constituent as c on c.id=g.constituent_id
			left join paguthi as p on p.id=g.paguthi_id
			left join seeker_type as st on st.id=g.seeker_type_id
			left join grievance_type as gt on gt.id=g.grievance_type_id
			left join grievance_sub_category as gsc on gsc.id=g.sub_category_id
			order by g.id desc LIMIT 1000";
			$result=$this->db->query($query);
			return $result->result();
		}

		function get_all_grievance_petition(){
			$query="SELECT g.*,c.full_name,c.address,c.door_no,c.pin_code,p.paguthi_name,st.seeker_info,gt.grievance_name,gsc.sub_category_name FROM grievance as g
			left join constituent as c on c.id=g.constituent_id
			left join paguthi as p on p.id=g.paguthi_id
			left join seeker_type as st on st.id=g.seeker_type_id
			left join grievance_type as gt on gt.id=g.grievance_type_id
			left join grievance_sub_category as gsc on gsc.id=g.sub_category_id where g.grievance_type='P'
			order by g.id desc LIMIT 1000";
			$result=$this->db->query($query);
			return $result->result();
		}

		function get_all_grievance_enquiry(){
			$query="SELECT g.*,c.full_name,c.address,c.door_no,c.pin_code,p.paguthi_name,st.seeker_info,gt.grievance_name,gsc.sub_category_name FROM grievance as g
			left join constituent as c on c.id=g.constituent_id
			left join paguthi as p on p.id=g.paguthi_id
			left join seeker_type as st on st.id=g.seeker_type_id
			left join grievance_type as gt on gt.id=g.grievance_type_id
			left join grievance_sub_category as gsc on gsc.id=g.sub_category_id where g.grievance_type='E'
			order by g.id desc LIMIT 1000";
			$result=$this->db->query($query);
			return $result->result();
		}


		function get_list_grievance_document($constituent_id){
				$id=base64_decode($constituent_id)/98765;
			$query="SELECT * FROM grievance_documents where constituent_id='$id' and grievance_id!='' order by id desc";
			$result=$this->db->query($query);
			return $result->result();
		}


		function get_grievance_status($grievance_id,$user_id){
			$select="SELECT * FROM grievance where id='$grievance_id'";
			$res_select   = $this->db->query($select);
			if($res_select->num_rows()==0){
			 $data=array("status"=>"error");
			 }else{
					 $data=array("status"=>"success","res"=>$res_select->result());
			 }
			 return $data;
		}


		function update_grievance_status($grievance_id,$status,$sms_text,$constituent_id,$sms_id,$user_id){
			$select="SELECT * FROM constituent where id='$constituent_id'";
			$res=$this->db->query($select);
			foreach($res->result() as $rows){}
			$to_phone=$rows->mobile_no;
			$smsContent=$sms_text;
			$this->smsmodel->sendSMS($to_phone,$smsContent);

			$insert="INSERT INTO grievance_reply (grievance_id,constituent_id,sms_flag,sms_template_id,sms_text,created_at,created_by) VALUES ('$grievance_id','$constituent_id','G','$sms_id','$sms_text',NOW(),'$user_id')";
			$result_insert=$this->db->query($insert);
			if($status=='COMPLETED'){
				$enquiry_status='P';
			}else{
				$enquiry_status='E';
			}

			$update="UPDATE grievance SET enquiry_status='$enquiry_status',status='$status',updated_at=NOW(),updated_by='$user_id' WHERE id='$grievance_id'";
			$result=$this->db->query($update);
			if($result){
					$data=array("status"=>"success","msg"=>"Grievance status updated Successfully!","class"=>"alert alert-success");
				}else{
					$data=array("status"=>"error","msg"=>"Something went wrong","class"=>"alert alert-danger");
				}
				return $data;
		}


		function reply_grievance_text($grievance_id,$sms_flag,$sms_text,$constituent_id,$sms_id,$user_id){
			$select="SELECT * FROM constituent where id='$constituent_id'";
			$res=$this->db->query($select);
			foreach($res->result() as $rows){}
			$to_phone=$rows->mobile_no;
			$smsContent=$sms_text;
			$this->smsmodel->sendSMS($to_phone,$smsContent);

			$insert="INSERT INTO grievance_reply (grievance_id,constituent_id,sms_flag,sms_template_id,sms_text,created_at,created_by) VALUES ('$grievance_id','$constituent_id','$sms_flag','$sms_id','$sms_text',NOW(),'$user_id')";
			$result_insert=$this->db->query($insert);
			if($result_insert){
					$data=array("status"=>"success","msg"=>"SMS sent Successfully!","class"=>"alert alert-success");
				}else{
					$data=array("status"=>"error","msg"=>"Something went wrong","class"=>"alert alert-danger");
				}
				return $data;
		}


		function update_refernce_note($grievance_id,$reference_note,$user_id){
			$update="UPDATE grievance SET reference_note='$reference_note',updated_at=NOW(),updated_by='$user_id' WHERE id='$grievance_id'";
			$result=$this->db->query($update);
			if($result){
					$data=array("status"=>"success","msg"=>"Grievance reference updated Successfully!","class"=>"alert alert-success");
				}else{
					$data=array("status"=>"error","msg"=>"Something went wrong","class"=>"alert alert-danger");
				}
				return $data;
		}

		function update_grievance_data($grievance_id,$seeker_id,$office_id,$reference_note,$sub_category_id,$grievance_tb_id,$description,$user_id){
			$id=base64_decode($grievance_tb_id)/98765;
			$update="UPDATE grievance SET seeker_type_id='$seeker_id',office_id='$office_id',grievance_type_id='$grievance_id',sub_category_id='$sub_category_id',description='$description',reference_note='$reference_note',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
			$result=$this->db->query($update);
			if($result){
					$data=array("status"=>"success","msg"=>"Grievance updated Successfully!","class"=>"alert alert-success");
				}else{
					$data=array("status"=>"error","msg"=>"Something went wrong","class"=>"alert alert-danger");
				}
				return $data;
		}

		function list_grievance_reply($rowno,$rowperpage,$search_text){
			$this->db->select('gr.*,c.full_name,u.full_name as sent_by');
			$this->db->from('grievance_reply as gr');
			$this->db->join('constituent as c', 'c.id = gr.constituent_id', 'left');
			$this->db->join('user_master as u', 'u.id = gr.created_by', 'left');
			if(empty($search)){

			}else{
				$this->db->or_where('c.full_name',$search);
			}
			$this->db->order_by("gr.id", "desc");
			// echo $this->db->get_compiled_select(); // before $this->db->get();
			// exit;
			$this->db->limit($rowperpage, $rowno);
			$query = $this->db->get();
			return $query->result_array();
		}



		function get_constituent_grievance_edit($grievance_id){
			$id=base64_decode($grievance_id)/98765;
			$query="SELECT g.*,c.full_name,p.paguthi_name,st.seeker_info,gt.grievance_name,gsc.sub_category_name FROM grievance as g
			left join constituent as c on c.id=g.constituent_id
			left join paguthi as p on p.id=g.paguthi_id
			left join seeker_type as st on st.id=g.seeker_type_id
			left join grievance_type as gt on gt.id=g.grievance_type_id
			left join grievance_sub_category as gsc on gsc.id=g.sub_category_id
			where  g.id='$id'";
			$result=$this->db->query($query);
			return $result->result();
		}



################## Grievance module ##############

################## Constituent Profile view only ##############

	function get_constituent_profile($constituent_id){
		$id=base64_decode($constituent_id)/98765;
		$query="SELECT c.*,ct.constituency_name,c.full_name,p.paguthi_name,w.ward_name,b.booth_name,b.booth_address,r.religion_name from constituent as c
		left join constituency as ct on ct.id=c.constituency_id
		left join paguthi as p on p.id=c.paguthi_id
		left join ward as w on w.id=c.ward_id
		left join booth as b on b.id=c.booth_id
		left join religion as r on r.id=c.religion_id
		where c.id='$id'";
		$result=$this->db->query($query);
		return $result->result();
	}


	function get_constituent_grievance($constituent_id){
			$id=base64_decode($constituent_id)/98765;
			$query="SELECT g.*,c.full_name,p.paguthi_name,st.seeker_info,gt.grievance_name,gsc.sub_category_name FROM grievance as g
			left join constituent as c on c.id=g.constituent_id
			left join paguthi as p on p.id=g.paguthi_id
			left join seeker_type as st on st.id=g.seeker_type_id
			left join grievance_type as gt on gt.id=g.grievance_type_id
			left join grievance_sub_category as gsc on gsc.id=g.sub_category_id
			where  g.constituent_id='$id'";
			$result=$this->db->query($query);
			return $result->result();
	}

	function get_constituent_meeting($constituent_id){
			$id=base64_decode($constituent_id)/98765;
			$query="SELECT * FROM meeting_request where constituent_id='$id' order by id desc";
			$result=$this->db->query($query);
			return $result->result();
	}

	function get_constituent_plant($constituent_id){
		$id=base64_decode($constituent_id)/98765;
		$query="SELECT * FROM plant_donation where constituent_id='$id'";
		$result=$this->db->query($query);
		return $result->result();
	}
	################## Constituent Profile view only ##############


	function get_all_birtday_count($selMonth){
		$this->db->select('count(c.id) as allcount');
		$this->db->from('constituent as c');
		$this->db->join('consitutent_birthday_wish as bw', 'c.id = bw.constituent_id', 'left outer');
		$this->db->where("not exists (select bw.constituent_id from consitutent_birthday_wish  as bw where bw.constituent_id = c.id)",null,false);

		if(empty($selMonth)){
			$month = date("m");
			$this->db->where('MONTH(c.dob)=', $month);
		}else{

			$this->db->where('MONTH(c.dob)=', $selMonth);
		}

		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}


	function get_birthday_report($rowno,$rowperpage,$selMonth)
	{

		$this->db->select('bw.id as wish_id,c.*');
		$this->db->from('constituent as c');
		$this->db->join('consitutent_birthday_wish as bw', 'c.id = bw.constituent_id', 'left outer');
		// $this->db->where('MONTH(c.dob)=', $selMonth);
		$this->db->where("not exists (select bw.constituent_id from consitutent_birthday_wish  as bw where bw.constituent_id = c.id)",null,false);
		if(empty($selMonth)){
			$month = date("m");
			$this->db->where('MONTH(c.dob)=', $month);
			// $this->db->where('MONTH(c.dob)=', $selMonth);

		}else{
			$this->db->where('MONTH(c.dob)=', $selMonth);
		}


		$this->db->limit($rowperpage, $rowno);
		// echo $this->db->get_compiled_select(); // before $this->db->get();
		// exit;
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_export_birthday($selMonth){
		$this->db->select('c.full_name,c.father_husband_name,c.mobile_no,c.dob,c.door_no,c.address');
		$this->db->from('constituent as c');
		$this->db->join('consitutent_birthday_wish as bw', 'c.id = bw.constituent_id', 'left outer');
		// $this->db->where('MONTH(c.dob)=', $selMonth);
		$this->db->where("not exists (select bw.constituent_id from consitutent_birthday_wish  as bw where bw.constituent_id = c.id)",null,false);
		if(empty($selMonth)){
			$month = date("m");
			$this->db->where('MONTH(c.dob)=', $month);
			// $this->db->where('MONTH(c.dob)=', $selMonth);

		}else{
			$this->db->where('MONTH(c.dob)=', $selMonth);
		}
		// echo $this->db->get_compiled_select(); // before $this->db->get();
		// exit;
		 return $query = $this->db->get();
	}
	function birthday_update($constituent_id,$user_id)
	{

			$insert="INSERT INTO consitutent_birthday_wish (constituent_id,birthday_letter_status,created_by,created_at) VALUES ('$constituent_id','Send','$user_id',NOW())";
			$result=$this->db->query($insert);
			if($result){
				$data = array('status' =>'success');
			} else {
				$data = array('status' =>'failure');
			}
			return $data;

	}

	function get_meeting_report($rowno,$rowperpage,$search_text,$frmDate,$toDate)
	{

		$this->db->select('A.*,B.full_name,B.mobile_no,C.full_name AS created_by,A.created_at');
		$this->db->from('meeting_request as A');
		$this->db->join('constituent as B', 'B.id = A.constituent_id', 'left');
		$this->db->join('user_master as C', 'C.id = A.created_by', 'left');
		if(empty($search_text)){

		}else{
			$this->db->or_like('B.full_name',$search_text);
		}
		if(empty($frmDate)){

		}else{
			$from_date=date("Y-m-d", strtotime($frmDate) );
			$to_date=date("Y-m-d", strtotime($toDate) );
			$this->db->where('DATE(A.created_at) >=', $from_date);
			$this->db->where('DATE(A.created_at) <=', $to_date);

		}


		$this->db->order_by("A.id", "desc");
			// echo $this->db->get_compiled_select(); // before $this->db->get();
			// exit;
		$this->db->limit($rowperpage, $rowno);
		$query = $this->db->get();
		return $query->result_array();
	}


	function meeting_update($meeting_id,$user_id,$frmDate,$toDate)
	{
		$update="UPDATE meeting_request SET meeting_status='COMPLETED',updated_at=NOW(),updated_by='$user_id' where id='$meeting_id'";
		$result=$this->db->query($update);

		if ($result) {
		   $this->session->set_flashdata('msg', 'You have just updated the meeting request!');
			redirect(base_url().'constituent/meetings/'.$frmDate.'/'.$toDate);
		} else {
		   $this->session->set_flashdata('msg', 'Failed to Update');
			redirect(base_url().'constituent/meetings/'.$frmDate.'/'.$toDate);
		}
	}

	function save_meeting_request_status($meeting_id,$constituent_id,$meeting_status,$meeting_date,$send_checkbox,$reply_sms_id,$reply_sms_text,$user_id){
		if($send_checkbox=='1'){
			$select="SELECT * FROM constituent where id='$constituent_id'";
			$res=$this->db->query($select);
			foreach($res->result() as $rows){}
			$to_phone=$rows->mobile_no;
			$smsContent=$reply_sms_text;
			$this->smsmodel->sendSMS($to_phone,$smsContent);
			$insert="INSERT INTO grievance_reply (constituent_id,sms_flag,sms_template_id,sms_text,created_at,created_by) VALUES ('$constituent_id','M','$reply_sms_id','$reply_sms_text',NOW(),'$user_id')";
			$result_insert=$this->db->query($insert);
		}

		 $id=base64_decode($meeting_id)/98765;
		 $update="UPDATE meeting_request SET meeting_status='$meeting_status',meeting_date='$meeting_date',updated_at=NOW(),updated_by='$user_id' where id='$id'";
		 $result=$this->db->query($update);
			if($result){
				$data=array("status"=>"success","msg"=>"Constituent Meeting status Updated","class"=>"alert alert-success");
			}else{
				$data=array("status"=>"error","msg"=>"Something went wrong","class"=>"alert alert-danger");
			}
			return $data;

	}



// Fetch records
function getConstituent($rowno,$rowperpage,$search_text="") {

	$this->db->select('c.*,p.paguthi_name');
	$this->db->from('constituent as c');
	$this->db->join('paguthi as p', 'p.id = c.paguthi_id', 'left');

			$search_key_1 = '';
			$search_key_2 = '';

	if($search_text != ''){

		$search_key = (explode(",",$search_text));
		$search_key_count = count($search_key);

		if ($search_key_count >=0){
							$search_key_1 = trim(strtoupper($search_key[0]));
					 }

					if ($search_key_count >1) {
							$search_key_2 = trim(strtoupper($search_key[1]));
					}

		if ($search_key_2 != ''){
			 $this->db->like('full_name', $search_key_1,'after');
			 $this->db->like('address', $search_key_2);
		} else {
			$this->db->or_like('full_name', $search_key_1,'after');
			$this->db->or_like('mobile_no', $search_key_1);
			$this->db->or_like('voter_id_no', $search_key_1);
			$this->db->or_like('aadhaar_no', $search_key_1);
			$this->db->or_like('serial_no', $search_key_1);
		}


	}
	$this->db->order_by("c.id", "desc");
	$this->db->limit($rowperpage, $rowno);
	// echo $this->db->get_compiled_select(); exit;
	$query = $this->db->get();

	return $query->result_array();
}

  // Select total records
	 function getConstituentcount($search_text = '') {

		$this->db->select('count(*) as allcount');
		$this->db->from('constituent');

		if($search_text != ''){
			$this->db->or_like('full_name', $search_text);
			// $this->db->or_like('father_husband_name', $search);
			// $this->db->or_like('guardian_name', $search);
			$this->db->or_like('mobile_no', $search_text);
			// $this->db->or_like('whatsapp_no', $search);
			// $this->db->or_like('address', $search);
			// $this->db->or_like('pin_code', $search);
			// $this->db->or_like('email_id', $search_text);
			$this->db->or_like('voter_id_no', $search_text);
			$this->db->or_like('aadhaar_no', $search_text);
			$this->db->or_like('serial_no', $search_text);
		}
			// echo $this->db->get_compiled_select(); exit;
		$query = $this->db->get();
		$result = $query->result_array();

		return $result[0]['allcount'];
  }

	public function exportConstituent($search = '') {

		$this->db->select('full_name,father_husband_name,mobile_no,door_no,address,pin_code,aadhaar_no,voter_id_no,serial_no,status');
		$this->db->from('constituent');

		if($search != ''){
				$this->db->like('full_name', $search);
				$this->db->or_like('father_husband_name', $search);
				$this->db->or_like('guardian_name', $search);
				$this->db->or_like('mobile_no', $search);
				$this->db->or_like('whatsapp_no', $search);
				$this->db->or_like('address', $search);
				$this->db->or_like('pin_code', $search);
				$this->db->or_like('email_id', $search);
				$this->db->or_like('voter_id_no', $search);
				$this->db->or_like('aadhaar_no', $search);
				$this->db->or_like('serial_no', $search);
		}
		$query = $this->db->get();
		$result = $query->result_array();

		return $query->result_array();
  }



	function getrecordconscount($search_text = '') {

				$this->db->select('count(*) as allcount');
				$this->db->from('constituent');
				$search_key_1 = '';
				$search_key_2 = '';

				if($search_text != ''){

				$search_key = (explode(",",$search_text));
				$search_key_count = count($search_key);

				if ($search_key_count >=0){
						$search_key_1 = trim(strtoupper($search_key[0]));
				}

				if ($search_key_count >1) {
						$search_key_2 = trim(strtoupper($search_key[1]));
				}

				if ($search_key_2 != ''){
							$this->db->or_like('full_name', $search_key_1,'after');
							$this->db->like('address', $search_key_2);
				} else {
						$this->db->or_like('full_name', $search_key_1,'after');
						$this->db->or_like('mobile_no', $search_key_1);
						$this->db->or_like('voter_id_no', $search_key_1);
						$this->db->or_like('aadhaar_no', $search_key_1);
						$this->db->or_like('serial_no', $search_key_1);
				}


				}
				// echo $this->db->get_compiled_select(); exit;
				$query = $this->db->get();
				$result = $query->result_array();

				return $result[0]['allcount'];
 }



	 function getrecordCount($search = '') {

		$this->db->select('count(*) as allcount');
		$this->db->from('grievance');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}

	function get_meeting_count($search_text,$frmDate,$toDate){
		$this->db->select('count(A.id) as allcount');
		$this->db->from('meeting_request as A');
		$this->db->join('constituent as B', 'B.id = A.constituent_id', 'left');
		$this->db->join('user_master as C', 'C.id = A.created_by', 'left');
		if(empty($search_text)){

		}else{
			$this->db->or_like('B.full_name',$search_text);
		}
		if(empty($frmDate)){

		}else{
			// $first=date("Y-m-d", strtotime($frmDate));
			// $second=date("Y-m-d", strtotime($toDate));
			// $where="(`A`.`created_at` >= '$first' AND `A`.`created_at` <= '$second')";
			// $this->db->or_where($where);
			$from_date=date("Y-m-d", strtotime($frmDate) );
			$to_date=date("Y-m-d", strtotime($toDate) );
			$this->db->where('DATE(A.created_at) >=', $from_date);
			$this->db->where('DATE(A.created_at) <=', $to_date);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}

	 function getrecordreplycount($search = '') {

		$this->db->select('count(*) as allcount');
		$this->db->from('grievance_reply');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}

	function get_all_grievance_count($search){
		$this->db->select('count(g.id) as allcount');
		$this->db->from('grievance as g');
		$this->db->join('constituent as c', 'c.id = g.constituent_id', 'left');
		$this->db->join('paguthi as p', 'p.id = g.paguthi_id', 'left');
		$this->db->join('seeker_type as st', 'st.id = g.seeker_type_id', 'left');
		$this->db->join('grievance_type as gt', 'gt.id = g.grievance_type_id', 'left');
		$this->db->join('grievance_sub_category as gsc', 'gsc.id = g.sub_category_id', 'left');
		if(empty($search)){

		}else{
			$where="(`g`.`reference_note` = '$search' OR `g`.`petition_enquiry_no` LIKE '%$search%' ESCAPE '!' OR `c`.`full_name` LIKE '%$search%' ESCAPE '!') ";
			$this->db->where($where);
		}

		// echo $this->db->get_compiled_select(); exit;
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}

	function all_grievance($rowno,$rowperpage,$search=""){
		$this->db->select('g.*,c.full_name,c.mobile_no,c.address,c.door_no,c.pin_code,p.paguthi_name,st.seeker_info,gt.grievance_name,gsc.sub_category_name');
		$this->db->from('grievance as g');
		$this->db->join('constituent as c', 'c.id = g.constituent_id', 'left');
		$this->db->join('paguthi as p', 'p.id = g.paguthi_id', 'left');
		$this->db->join('seeker_type as st', 'st.id = g.seeker_type_id', 'left');
		$this->db->join('grievance_type as gt', 'gt.id = g.grievance_type_id', 'left');
		$this->db->join('grievance_sub_category as gsc', 'gsc.id = g.sub_category_id', 'left');
		if(empty($search)){

		}else{
			// $this->db->or_like('g.reference_note',$search,'both');
			// $this->db->or_like('g.petition_enquiry_no',$search,'both');
			// $this->db->or_like('c.full_name',$search,'both');
			$where="(`g`.`reference_note` = '$search' OR `g`.`petition_enquiry_no` LIKE '%$search%' ESCAPE '!' OR `c`.`full_name` LIKE '%$search%' ESCAPE '!') ";
			$this->db->where($where);
		}
		$this->db->order_by("g.id", "desc");
		// echo $this->db->get_compiled_select(); // before $this->db->get();
		// exit;
		$this->db->limit($rowperpage, $rowno);
		$query = $this->db->get();
		return $query->result_array();
	}


	function all_petition($rowno,$rowperpage,$search=""){
		$this->db->select('g.*,c.full_name,c.mobile_no,c.address,c.door_no,c.pin_code,p.paguthi_name,st.seeker_info,gt.grievance_name,gsc.sub_category_name');
		$this->db->from('grievance as g');
		$this->db->join('constituent as c', 'c.id = g.constituent_id', 'left');
		$this->db->join('paguthi as p', 'p.id = g.paguthi_id', 'left');
		$this->db->join('seeker_type as st', 'st.id = g.seeker_type_id', 'left');
		$this->db->join('grievance_type as gt', 'gt.id = g.grievance_type_id', 'left');
		$this->db->join('grievance_sub_category as gsc', 'gsc.id = g.sub_category_id', 'left');
		if(empty($search)){

		}else{
			$where="(`g`.`reference_note` = '$search' OR `g`.`petition_enquiry_no` LIKE '%$search%' ESCAPE '!' OR `c`.`full_name` LIKE '%$search%' ESCAPE '!') ";
			$this->db->where($where);
			// $this->db->or_like('g.reference_note',$search);
			// $this->db->or_like('g.petition_enquiry_no',$search);
			// $this->db->or_like('c.full_name',$search);
		}
		$this->db->where('g.grievance_type','P');
		$this->db->order_by("g.id", "desc");
		// echo $this->db->get_compiled_select(); // before $this->db->get();
		// exit;
		$this->db->limit($rowperpage, $rowno);
		$query = $this->db->get();
		return $query->result_array();
	}


	function all_enquiry($rowno,$rowperpage,$search=""){
		$this->db->select('g.*,c.full_name,c.mobile_no,c.address,c.door_no,c.pin_code,p.paguthi_name,st.seeker_info,gt.grievance_name,gsc.sub_category_name');
		$this->db->from('grievance as g');
		$this->db->join('constituent as c', 'c.id = g.constituent_id', 'left');
		$this->db->join('paguthi as p', 'p.id = g.paguthi_id', 'left');
		$this->db->join('seeker_type as st', 'st.id = g.seeker_type_id', 'left');
		$this->db->join('grievance_type as gt', 'gt.id = g.grievance_type_id', 'left');
		$this->db->join('grievance_sub_category as gsc', 'gsc.id = g.sub_category_id', 'left');
		$this->db->where('g.grievance_type','E');
		if(empty($search)){

		}else{
			$where="(`g`.`reference_note` = '$search' OR `g`.`petition_enquiry_no` LIKE '%$search%' ESCAPE '!' OR `c`.`full_name` LIKE '%$search%' ESCAPE '!') ";
			$this->db->where($where);

			// $this->db->or_like('g.petition_enquiry_no',$search);
			// $this->db->or_like('c.full_name',$search);
		}

		$this->db->order_by("g.id", "desc");
		// echo $this->db->get_compiled_select(); // before $this->db->get();
		// exit;
		$this->db->limit($rowperpage, $rowno);
		$query = $this->db->get();
		return $query->result_array();
	}


	function get_enquiry_search_count($search_text){
		$this->db->select('count(g.id) as allcount');
		$this->db->from('grievance as g');
		$this->db->join('constituent as c', 'c.id = g.constituent_id', 'left');
		$this->db->join('paguthi as p', 'p.id = g.paguthi_id', 'left');
		$this->db->join('seeker_type as st', 'st.id = g.seeker_type_id', 'left');
		$this->db->join('grievance_type as gt', 'gt.id = g.grievance_type_id', 'left');
		$this->db->join('grievance_sub_category as gsc', 'gsc.id = g.sub_category_id', 'left');
		$this->db->where('g.grievance_type','E');
		if(empty($search_text)){

		}else{
			$where="(`g`.`reference_note` = '$search_text' OR `g`.`petition_enquiry_no` LIKE '%$search_text%' ESCAPE '!' OR `c`.`full_name` LIKE '%$search_text%' ESCAPE '!') ";
			$this->db->where($where);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}


	function get_petition_search_count($search_text){
		$this->db->select('count(g.id) as allcount');
		$this->db->from('grievance as g');
		$this->db->join('constituent as c', 'c.id = g.constituent_id', 'left');
		$this->db->join('paguthi as p', 'p.id = g.paguthi_id', 'left');
		$this->db->join('seeker_type as st', 'st.id = g.seeker_type_id', 'left');
		$this->db->join('grievance_type as gt', 'gt.id = g.grievance_type_id', 'left');
		$this->db->join('grievance_sub_category as gsc', 'gsc.id = g.sub_category_id', 'left');
		$this->db->where('g.grievance_type','P');
		if(empty($search_text)){

		}else{
			$where="(`g`.`reference_note` = '$search_text' OR `g`.`petition_enquiry_no` LIKE '%$search_text%' ESCAPE '!' OR `c`.`full_name` LIKE '%$search_text%' ESCAPE '!') ";
			$this->db->where($where);
		}
		// echo $this->db->get_compiled_select(); // before $this->db->get();
		// exit;
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}


//------ Constituent Video -----//
	function get_constituent_video($constituent_id,$user_id){
		$query="SELECT id,constituent_id
,video_title,video_link,DATE_FORMAT(updated_at,'%d-%m-%Y %H:%i') as updated_at FROM constituent_video where constituent_id='$constituent_id' order by id desc";
		$result=$this->db->query($query);
		if($result->num_rows()==0){
 		$data=array("status"=>"error");
 		}else{
 			$data=array("status"=>"success","res"=>$result->result());
 		}
 	return $data;
	}


		function save_video_link($constituent_id,$video_title,$video_link,$user_id){
			$select="SELECT * FROM constituent_video Where video_title='$video_title' and constituent_id='$constituent_id'";
				$result=$this->db->query($select);
				if($result->num_rows()==0){
						$insert="INSERT INTO constituent_video (constituent_id,video_title,video_link,status,updated_at,updated_by) VALUES ('$constituent_id','$video_title','$video_link','ACTIVE',NOW(),'$user_id')";
						$result=$this->db->query($insert);
						if($result){
							$data=array("status"=>"success","msg"=>"Video added Successfully!","class"=>"alert alert-success");
						}else{
							$data=array("status"=>"error","msg"=>"Something went wrong","class"=>"alert alert-danger");
						}

				}else{
					$data=array("status"=>"error","msg"=>"Video added exists","class"=>"alert alert-danger");
				}
				return $data;
		}

//------ Constituent Video -----//


	function fetch_festival_data($rowno,$rowperpage,$paguthi,$ward_id,$religion_id) {
			$this->db->select('c.*,f.constituent_id as sent_status,f.festival_id as sent_festival_id');
			$this->db->from('constituent as c');


			if(empty($religion_id)){
				$this->db->join('festival_wishes as f', 'f.constituent_id = c.id', 'left');
			}else{
				$this->db->join('festival_wishes as f', 'f.constituent_id = c.id and f.festival_id='.$religion_id, 'left');
				$this->db->join('festival_master as fm', 'fm.religion_id = c.religion_id', 'left');
				// $this->db->or_where('fm.id',$religion_id);
				$this->db->where('fm.id',$religion_id);

			}
			if(empty($paguthi)){

			}else{
				$this->db->where('c.paguthi_id',$paguthi);
			}
			if(empty($ward_id)){

			}else{
				$this->db->where('c.office_id',$ward_id);
			}
			$this->db->where("not exists (select fw.constituent_id from festival_wishes  as fw where fw.constituent_id = c.id)",null,false);



			$this->db->group_by('c.id');
			// echo $this->db->get_compiled_select(); // before $this->db->get();
			// exit;
			$this->db->limit($rowperpage, $rowno);
			$query = $this->db->get();
			return $query->result_array();

	 }


	 function festival_wishes_count($paguthi,$ward_id,$religion_id){
		 $this->db->select('count(c.id) as allcount');
		 $this->db->from('constituent as c');


		 if(empty($religion_id)){
			 $this->db->join('festival_wishes as f', 'f.constituent_id = c.id', 'left');
		 }else{
			 $this->db->join('festival_wishes as f', 'f.constituent_id = c.id and f.festival_id='.$religion_id, 'left');
			 $this->db->join('festival_master as fm', 'fm.religion_id = c.religion_id', 'left');
			 // $this->db->or_where('fm.id',$religion_id);
			 $this->db->where('fm.id',$religion_id);

		 }
		 if(empty($paguthi)){

		 }else{
			 $this->db->where('c.paguthi_id',$paguthi);
		 }
		 if(empty($ward_id)){

		 }else{
			 $this->db->where('c.office_id',$ward_id);
		 }
		 $this->db->where("not exists (select fw.constituent_id from festival_wishes  as fw where fw.constituent_id = c.id)",null,false);
		 $query = $this->db->get();
		 $result = $query->result_array();
		 return $result[0]['allcount'];
	 }


	 function get_export_festival($religion_id,$paguthi,$ward_id){
		 $this->db->select('c.full_name,c.father_husband_name,c.mobile_no,c.door_no,c.address');
		 $this->db->from('constituent as c');


		 if(empty($religion_id)){
			 $this->db->join('festival_wishes as f', 'f.constituent_id = c.id', 'left');
		 }else{
			 $this->db->join('festival_wishes as f', 'f.constituent_id = c.id and f.festival_id='.$religion_id, 'left');
			 $this->db->join('festival_master as fm', 'fm.religion_id = c.religion_id', 'left');
			 // $this->db->or_where('fm.id',$religion_id);
			 $this->db->where('fm.id',$religion_id);

		 }
		 if(empty($paguthi)){

		 }else{
			 $this->db->where('c.paguthi_id',$paguthi);
		 }
		 if(empty($ward_id)){

		 }else{
			 $this->db->where('c.ward_id',$ward_id);
		 }
		 $this->db->where("not exists (select fw.constituent_id from festival_wishes  as fw where fw.constituent_id = c.id)",null,false);



		 $this->db->group_by('c.id');
		 // echo $this->db->get_compiled_select(); // before $this->db->get();
		 // exit;
		return $query = $this->db->get();
	 }
}
?>
