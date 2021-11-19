                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= form_error('role', '<div class="alert alert-danger mb-2" role="alert">', '</div>'); ?>
                            <?= $this->session->flashdata('role') ?>

                          <a href="" class="btn btn-primary" data-toggle="modal" data-target="#role">Add New Role</a>

                            <table class="table table-hover mt-2">
                              <thead>
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Role</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                 $i = 1;
                                 foreach ($role as $r) : ?>
                                <tr>
                                  <th scope="row"><?= $i++ ?></th>
                                  <td><?= $r['role'] ?></td>
                                  <td>
                                      <a href="<?= base_url('admin/roleaccess/') . $r['id'] ;?>" class="badge badge-pill badge-warning">Access</a>
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
            <div class="modal fade" id="role" tabindex="-1" aria-labelledby="roleLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="roleLabel">Add new role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="<?= base_url() ?>admin/role" method="post">
                      <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="role" name="role" placeholder="role title...">
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