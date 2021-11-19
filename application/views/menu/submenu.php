                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

                    <div class="row">
                        <div class="col-lg">
                          <?php if(validation_errors()) :  ?>
                            <div class="alert alert-danger" role="alert">
                            <?= validation_errors() ?>
                            </div>
                          <?php endif; ?>
                          <!-- <?= $this->session->flashdata('submenu'); ?> -->
                          <a href="" class="btn btn-primary" data-toggle="modal" data-target="#subMenu">Add New Submenu</a>

                            <table class="table table-hover mt-2">
                              <thead>
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Title</th>
                                  <th scope="col">Menu</th>
                                  <th scope="col">Url</th>
                                  <th scope="col">Icon</th>
                                  <th scope="col">Active</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                 $i = 1;
                                 foreach ($getsubmenu as $sub) : ?>
                                <tr>
                                  <th scope="row"><?= $i++ ?></th>
                                  <td><?= $sub['title'] ?></td>
                                  <td><?= $sub['menu'] ?></td>
                                  <td><?= $sub['url'] ?></td>
                                  <td><?= $sub['icon'] ?></td>
                                  <td><?= $sub['is_active'] ?></td>
                                  <td>
                                      <a href="" class="badge badge-pill badge-success">Edit</a>
                                      <a href="" class="badge badge-pill badge-danger">Delete</a>
                                  </td>
                                </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Modal -->
            <div class="modal fade" id="subMenu" tabindex="-1" aria-labelledby="subMenuLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="subMenuLabel">Add new submenu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="<?= base_url() ?>menu/submenu" method="post">
                      <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="submenu" name="submenu" placeholder="Submenu title...">
                        </div>
                        <div class="form-group">
                          <select name="menu_id" id="menu_id" class="form-control">
                            <option value=""></option>
                            <?php foreach($getmenu as $sm): ?>
                              <option value="<?= $sm['id'] ?>"><?= $sm['menu'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url...">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon...">
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <input type="checkbox" aria-label="Checkbox for following text input"  value="1" name="active" id="active" checked>
                            </div>
                          </div>
                          <input type="text" class="form-control disable" aria-label="Text input with checkbox" placeholder="Click to active">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cencel</button>
                        <button type="submit" class="btn btn-primary">Insert</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>