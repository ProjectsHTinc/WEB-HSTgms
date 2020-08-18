<div  class="right_col" role="main">
   <div class="">
      <div class="col-md-12 col-sm-12 ">
         <div class="x_panel">
            <div class="x_title">
               <h2>Video Report</h2>

               <div class="clearfix"></div>
            </div>
            <div class="x_content">
			<?php if($this->session->flashdata('msg')): ?>
		<div class="alert alert-success alert-dismissible " role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
		</button>
		<?php echo $this->session->flashdata('msg'); ?>
		</div>
	<?php endif; ?>

		<form id="report_form" action="<?php echo base_url(); ?>report/video" method="post" enctype="multipart/form-data">

        <div class="form-group row ">
             <label class="col-form-label col-md-2 col-sm-3 label-align">Office<span class="required">*</span></label>
             <div class="col-md-2 col-sm-9 ">
             <select class="form-control" name="paguthi" id ="paguthi" onchange="get_paguthi(this);">
               <option value="">ALL</option>
               <?php foreach($paguthi as $rows){ ?>
               <option value="<?php echo $rows->id;?>"><?php echo $rows->paguthi_name;?></option>
               <?php } ?>
             </select>
             <script> $('#paguthi').val('<?php echo $paguthi_id; ?>');</script>
           </div>
           <label class="col-form-label col-md-2 col-sm-3 label-align">Ward</label>
          <div class="col-md-2 col-sm-2">
             <select class="form-control" name="ward_id" id ="ward_id" >
               <option value=""></option>
             </select>
          </div>
          <div class="col-md-2 col-sm-2">
            <button type="submit" class="btn btn-success">SEARCH</button>
          </div>

         </div>
			  <div class="ln_solid"></div>
		</form>

		<div class="col-md-12 col-sm-12 ">
      <div class="col-md-12 col-sm-12" style="padding:0px;">
         <div class="col-md-3 col-sm-3">
            <h2>Search Result</h2>
            Total records <?php echo $allcount; ?>
         </div>
         <div class="col-md-3 col-sm-3"></div>
         <div class="col-md-6 col-sm-6" style="padding:0px;"><?= $pagination; ?></div>
      </div>
          <table id="" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
             <thead>
                <tr>
                    <th>S.no </th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Video title</th>
                    <th>Update by</th>
                    <th>Updated</th>
                </tr>
             </thead>
             <tbody>
               <?php
			    if (count($result) >0) {
				$i = $row+1;
					foreach($result as $rows){

			   ?>
                 <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $rows['full_name']; ?></td>

                    <td><?php echo $rows['mobile_no']; ?></td>
                    <td><?php echo $rows['door_no']; ?><br><?php echo $rows['address']; ?><br><?php echo $rows['pin_code']; ?></td>
                    <td><a href="<?php echo $rows['video_link']; ?>" target="_blank"><?php echo $rows['video_title']; ?></a></td>
                    <td><?php echo $rows['done_by']; ?></td>
                    <td><?php echo $rows['updated_at']; ?></td>

                 </tr>
				<?php $i++; } } ?>
             </tbody>
          </table>
          <div class="col-md-12 col-sm-12" style="padding:0px;">
             <div class="col-md-3 col-sm-3"></div>
             <div class="col-md-3 col-sm-3"></div>
             <div class="col-md-6 col-sm-6" style="padding:0px;"><?= $pagination; ?></div>
          </div>
        </div>
            </div>
         </div>
      </div>



   </div>
</div>
<script type="text/javascript">
function get_paguthi(sel){
  var paguthi_id=sel.value;
  $.ajax({
		url:'<?php echo base_url(); ?>masters/get_active_ward',
		method:"POST",
		data:{paguthi_id:paguthi_id},
		dataType: "JSON",
		cache: false,
		success:function(data)
		{
		   var stat=data.status;
		   $("#ward_id").empty();

		   if(stat=="success"){
		   var res=data.res;
		   var len=res.length;
        $('#ward_id').html('<option value="">-SELECT ward --</option>');
		   for (i = 0; i < len; i++) {
		   $('<option>').val(res[i].id).text(res[i].ward_name).appendTo('#ward_id');
		   }

		   }else{
		   $("#ward_id").empty();

		   }
		}
	});
}




 </script>