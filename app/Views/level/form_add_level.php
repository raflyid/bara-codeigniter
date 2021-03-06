		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;"><?= $breadcrumb ?></a></li>
				<li class="breadcrumb-item"><a href="<?php echo base_url('level') ?>"><?= $title ?></a></li>
				<li class="breadcrumb-item active">Add New</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><?= $title ?> <small>Add New</small></h1>
			<!-- end page-header -->
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<!-- begin panel-heading -->
				<div class="panel-heading">
					<h4 class="panel-title">Add New <?= $title ?></h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
				</div>
				<!-- end panel-heading -->
				<!-- begin panel-body -->
				<div class="panel-body">
					<form action="<?php echo base_url('level/add') ?>" method="post">
						<?php $error = $validation->getError('level_name'); ?>
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-2 text-lg-right">Name<span class="text-grey-darker ml-2"><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="Level name (e.g., Admin)."></i></span></label>
							<div class="col-md-9">
								<input type="text" class="form-control <?php if($error){ echo 'is-invalid'; } ?>" name="level_name" value="<?= $request->getPost('level_name'); ?>" />
								<?php if($error){ echo '<div class="invalid-feedback">'.$error.'</div>'; } ?>
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-2 text-lg-right">Role<span class="text-grey-darker ml-2"><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="Level role."></i></span></label>
							<div class="col-md-9">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-td-valign-middle">
										<thead>
											<tr>
												<th width="1%">#</th>
												<th class="text-nowrap">Menu</th>
												<th class="text-nowrap">Read</th>
												<th class="text-nowrap">Create</th>
												<th class="text-nowrap">Update</th>
												<th class="text-nowrap">Delete</th>
												<th class="text-nowrap">Data</th>
											</tr>
										</thead>
										<tbody>
										<?php
											if(@$menu) :
												$no=0;
												$index=0;
												foreach ($menu as $mn) :
													$no++;
										?>
											<tr>
												<td><?= $no; ?></td>
												<td><input type="hidden" name="level_role[<?= $index; ?>][menu]" value="<?= $mn->menu_id; ?>" /><?= $mn->menu_name; ?></td>
												<td class="text-center">
													<div class="custom-control custom-checkbox mb-1">
														<input type="hidden" name="level_role[<?= $index; ?>][read]" value="0" />
														<input type="checkbox" class="custom-control-input" id="readCheck<?= $no; ?>" name="level_role[<?= $index; ?>][read]" value="1" <?php if($request->getPost('level_role['.$index.'][read]') == '1'){echo 'checked';} ?> />
														<label class="custom-control-label" for="readCheck<?= $no; ?>"></label>
													</div>
												</td>
												<td class="text-center">
													<div class="custom-control custom-checkbox mb-1">
														<input type="hidden" name="level_role[<?= $index; ?>][create]" value="0" />
														<input type="checkbox" class="custom-control-input" id="createCheck<?= $no; ?>" name="level_role[<?= $index; ?>][create]" value="1" <?php if($request->getPost('level_role['.$index.'][create]') == '1'){echo 'checked';} ?> />
														<label class="custom-control-label" for="createCheck<?= $no; ?>"></label>
													</div>
												</td>
												<td class="text-center">
													<div class="custom-control custom-checkbox mb-1">
														<input type="hidden" name="level_role[<?= $index; ?>][update]" value="0" />
														<input type="checkbox" class="custom-control-input" id="updateCheck<?= $no; ?>" name="level_role[<?= $index; ?>][update]" value="1" <?php if($request->getPost('level_role['.$index.'][update]') == '1'){echo 'checked';} ?> />
														<label class="custom-control-label" for="updateCheck<?= $no; ?>"></label>
													</div>
												</td>
												<td class="text-center">
													<div class="custom-control custom-checkbox mb-1">
														<input type="hidden" name="level_role[<?= $index; ?>][delete]" value="0" />
														<input type="checkbox" class="custom-control-input" id="deleteCheck<?= $no; ?>" name="level_role[<?= $index; ?>][delete]" value="1" <?php if($request->getPost('level_role['.$index.'][delete]') == '1'){echo 'checked';} ?> />
														<label class="custom-control-label" for="deleteCheck<?= $no; ?>"></label>
													</div>
												</td>
												<td class="text-center">
													<select class="default-select2" name="level_role[<?= $index; ?>][data]" style="width: 115px">
														<option value="DT02" <?php if($request->getPost('level_role['.$index.'][data]') == 'DT02'){echo 'selected';} ?>>Own</option>
														<option value="DT01" <?php if($request->getPost('level_role['.$index.'][data]') == 'DT01'){echo 'selected';} ?>>All</option>
													</select>
												</td>
											</tr>
										<?php
													$index++;
												endforeach;
											endif;
										?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<?php $error = $validation->getError('menu'); ?>
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-2 text-lg-right">Default Menu<span class="text-grey-darker ml-2"><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="Menu of the level."></i></span></label>
							<div class="col-md-9">
								<select class="default-select2 form-control <?php if($error){ echo 'is-invalid'; } ?>" name="menu" data-placeholder="Select a menu">
								<?php if(@$menu) : ?>
									<option></option>
								<?php foreach ($menu as $mn) : ?>
									<option value="<?= $mn->menu_id; ?>" <?php if($request->getPost('menu') == $mn->menu_id){echo 'selected';} ?>><?= $mn->menu_name ?></option>
								<?php
									endforeach;
								endif;
								?>
								</select>
								<?php if($error){ echo '<div class="invalid-feedback">'.$error.'</div>'; } ?>
							</div>
						</div>
						<div class="form-group row m-b-0">
							<div class="col-md-12 col-sm-12 text-center">
								<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>&nbsp;&nbsp;
								<a href="<?php echo base_url('level') ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>
							</div>
						</div>
					</form>
				</div>
				<!-- end panel-body -->
			</div>
			<!-- end panel -->
		</div>
		<!-- end #content -->