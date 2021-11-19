                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

                    <div class="row">
                        <div class="col-lg-6">
                        
                            <?= $this->session->flashdata('change') ?>

                            <h5>Role: <?= $role['role']; ?></h5>

                            <table class="table table-hover mt-2">
                              <thead>
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Menu</th>
                                  <th scope="col">Access</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                 $i = 1;
                                 foreach ($allmenu as $all) : ?>
                                <tr>
                                  <th scope="row"><?= $i++ ?></th>
                                  <td><?= $all['menu'] ?></td>
                                  <td>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $all['id']) ?> data-role="<?= $role['id'] ?>" data-menu="<?= $all['id'] ?>">
                                    </div>
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
