<div class="row">
            <div class="col-md-12">
						<div class="box">
						<div class='box-header with-border'>
						<div class="col-md-6">
							<h4 class='box-title'>Stok undangan</h4>
						</div>						
						<div class="col-md-6">
							<div class="pull-right">
							 <button type="submit" class="btn btn-primary " id="btnadd" name="btnadd"><i class="fa fa-plus"></i> Add</button>
							</div>
						</div>
						</div>
                               
						  <div class="box-body">
			<table id="data_grid"  class="table table-bordered table-hover">
					<thead>
						<tr class="tableheader">
							<th>#</th>
							<th>KODE</th>
							<th>MERK</th>
							<th>HARGA</th>
							<th>UKURAN</th>
							<th>OC</th>
							<th>MASTER</th>
							<th>L. PLASTIK</th>
							<th>H. PLASTIK</th>
							<th>S. MASUK</th>
							<th>S. KELUAR</th>
							<th>AKSI</th>
						</tr>
					</thead>
			</table>
							</div><!-- /.box-body -->  
                            </div><!-- /.box -->
                  </div><!-- /.tab-pane -->

          </div> <!-- /.row -->
              <div id="modalcust" class="modal">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">×</button>
                      <h4 class="modal-title">Input Stok</h4>
                    </div>
                    <!--modal header-->
                    <div class="modal-body">
                      <div class="pad" id="infopanel"></div>
                      <div class="form-horizontal">
						<div class="form-group"> 
							<div class="col-sm-6">
								<div class="input-group">
								<span class="input-group-addon">KODE</span>
								<input class="form-control" id="kode" placeholder="KODE" type="text">
								<input type="hidden" id="crudmethod" value="N"> 
								<input type="hidden" id="txtid" value="0">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
								<span class="input-group-addon">MERK</span>
								<input class="form-control" id="merk" placeholder="MERK" type="text">
								</div>
							</div>
						</div>
						<div class="form-group"> 
							<div class="col-sm-6">
								<div class="input-group">
								<span class="input-group-addon">HARGA</span>
								<input class="form-control" id="harga" placeholder="HARGA" type="text">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
								<span class="input-group-addon">UKURAN</span>
								<input class="form-control" id="uk" placeholder="UKURAN" type="text">
								</div>
							</div>
						</div>
						<div class="form-group"> 
							<div class="col-sm-6">
								<div class="input-group">
								<span class="input-group-addon">OC</span>
								<input class="form-control" id="oc" placeholder="OC" type="text">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
								<span class="input-group-addon">MASTER</span>
								<input class="form-control" id="master" placeholder="MASTER" type="text">
								</div>
							</div>
						</div>
						<div class="form-group"> 
							<div class="col-sm-6">
								<div class="input-group">
								<span class="input-group-addon">LEBAR PLASTIK</span>
								<input class="form-control" id="lp" placeholder="LEBAR PLASTIK" type="text">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
								<span class="input-group-addon">HARGA PLASTIK</span>
								<input class="form-control" id="hp" placeholder="HARGA PLASTIK" type="text">
								</div>
							</div>
						</div>
						<div class="form-group"> 
							<div class="col-sm-6">
								<div class="input-group">
								<span class="input-group-addon">STOK MASUK</span>
								<input class="form-control" id="sm" placeholder="STOK MASUK" type="text">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
								<span class="input-group-addon">STOK KELUAR</span>
								<input class="form-control" id="sk" placeholder="STOK KELUAR" type="text">
								</div>
							</div>
						</div>
                      </div>
                      <!--modal footer-->
                    </div>
					<div class="modal-footer">
						 <button type="submit" class="btn btn-primary " id="btnsave"><i class="fa fa-save"></i> Save</button>
						<button type="button" class="btn bg-red" data-dismiss="modal">Close</button>
					</div>
                    <!--modal-content-->
                  </div>
                  <!--modal-dialog modal-lg-->
                </div>
                <!--form-kantor-modal-->
              </div>