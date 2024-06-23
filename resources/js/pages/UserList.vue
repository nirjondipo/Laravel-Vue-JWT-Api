<template>
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Session</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">21,459</h3>
                                <p class="text-success mb-0">(+29%)</p>
                            </div>
                            <p class="mb-0">Total Users</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-primary">
                            <i class="ti ti-user ti-sm"></i>
                          </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Paid Users</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">4,567</h3>
                                <p class="text-success mb-0">(+18%)</p>
                            </div>
                            <p class="mb-0">Last week analytics</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-danger">
                            <i class="ti ti-user-plus ti-sm"></i>
                          </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Active Users</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">19,860</h3>
                                <p class="text-danger mb-0">(-14%)</p>
                            </div>
                            <p class="mb-0">Last week analytics</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-success">
                            <i class="ti ti-user-check ti-sm"></i>
                          </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Pending Users</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">237</h3>
                                <p class="text-success mb-0">(+42%)</p>
                            </div>
                            <p class="mb-0">Last week analytics</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-warning">
                            <i class="ti ti-user-exclamation ti-sm"></i>
                          </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Users List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-3">Search Filter</h5>
            <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                <div class="col-md-3 user_role">
                    <select id="UserRole" class="form-select text-capitalize">
                            <option value=""> Select Role </option><option value="Admin">Admin</option>
                            <option value="Author">Author</option><option value="Editor">Editor</option>
                            <option value="Maintainer">Maintainer</option><option value="Subscriber">Subscriber</option>
                        </select>
                </div>
                <div class="col-md-3 user_plan">
                    <select id="UserPlan" class="form-select text-capitalize">
                            <option value=""> Select Plan </option><option value="Basic">Basic</option>
                            <option value="Company">Company</option>
                            <option value="Enterprise">Enterprise</option>
                            <option value="Team">Team</option>
                        </select>
                </div>
                <div class="col-md-3 user_status">
                    <select id="FilterTransaction" class="form-select text-capitalize">
                            <option value=""> Select Status </option>
                            <option value="Pending" class="text-capitalize">Pending</option>
                            <option value="Active" class="text-capitalize">Active</option>
                            <option value="Inactive" class="text-capitalize">Inactive</option>
                        </select>
                </div>
                <div class="col-md-3 user_status">
                    <button class="btn btn-secondary add-new btn-info w-100" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser">
                        <span>
                            <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                            <span class="d-none d-sm-inline-block">Add New User</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>USER</th>
                            <th>User Type</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-3">
                                            <img src="assets/img/avatars/2.png" alt="Avatar" class="rounded-circle">
                                        </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a href="app-user-view-account.html" class="text-body text-truncate">
                                                <span class="fw-medium">Zsazsa McCleverty</span>
                                            </a>
                                            <small class="text-muted">zmcclevertye@soundcloud.com</small>
                                        </div>
                                    </div>
                            </td>
                            <td>
                                <span class="text-truncate d-flex align-items-center">
                                    <span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2">
                                        <i class="ti ti-device-laptop ti-sm"></i></span>Admin
                                    </span>
                            </td>
                            <td>
                               regsiter date
                            </td>
                            <td><span class="badge bg-label-success me-1">Completed</span></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="javascript:;" class="text-body">
                                        <i class="ti ti-edit ti-sm me-2"></i>
                                    </a>
                                    <a href="javascript:;" class="text-body delete-record">
                                        <i class="ti ti-trash ti-sm mx-2"></i></a>
                                        <a href="javascript:;" class="text-body dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-dots-vertical ti-sm mx-1"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end m-0" style="">
                                        <a href="app-user-view-account.html" class="dropdown-item">View</a>
                                        <a href="javascript:;" class="dropdown-item">Suspend</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation" class="p-3">
                <ul class="pagination">
                    <li class="page-item first disabled">
                        <a class="page-link" href="#"><i class="ti ti-chevrons-left ti-sm"></i></a>
                    </li>
                    <li class="page-item prev disabled">
                        <a class="page-link" href="#"><i class="ti ti-chevron-left ti-sm"></i></a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">4</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">5</a>
                    </li>
                    <li class="page-item next">
                        <a class="page-link" href="#"><i class="ti ti-chevron-right ti-sm"></i></a>
                    </li>
                    <li class="page-item last">
                        <a class="page-link" href="#"><i class="ti ti-chevrons-right ti-sm"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Offcanvas to add new user -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100 w-100">
                <form class="add-new-user pt-0" id="addNewUserForm" onsubmit="return false">
                    <div class="mb-3">
                        <label class="form-label" for="add-user-fullname">First Name</label>
                        <input type="text" class="form-control" id="add-user-fullname" placeholder="John" name="userFullname" aria-label="John Doe" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="add-user-fullname">Last Name</label>
                        <input type="text" class="form-control" id="add-user-fullname" placeholder="Doe" name="userFullname" aria-label="John Doe" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="add-user-email">Email</label>
                        <input type="text" id="add-user-email" class="form-control" placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="userEmail" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="add-user-contact">Contact</label>
                        <input type="text" id="add-user-contact" class="form-control phone-mask" placeholder="+1 (609) 988-44-11" aria-label="john.doe@example.com" name="userContact" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="country">Country</label>
                        <select id="country" class="select2 form-select">
                          <option value="">Select</option>
                          <option value="Australia">Australia</option>
                          <option value="Bangladesh">Bangladesh</option>
                          <option value="Belarus">Belarus</option>
                          <option value="Brazil">Brazil</option>
                          <option value="Canada">Canada</option>
                          <option value="China">China</option>
                          <option value="France">France</option>
                          <option value="Germany">Germany</option>
                          <option value="India">India</option>
                          <option value="Indonesia">Indonesia</option>
                          <option value="Israel">Israel</option>
                          <option value="Italy">Italy</option>
                          <option value="Japan">Japan</option>
                          <option value="Korea">Korea, Republic of</option>
                          <option value="Mexico">Mexico</option>
                          <option value="Philippines">Philippines</option>
                          <option value="Russia">Russian Federation</option>
                          <option value="South Africa">South Africa</option>
                          <option value="Thailand">Thailand</option>
                          <option value="Turkey">Turkey</option>
                          <option value="Ukraine">Ukraine</option>
                          <option value="United Arab Emirates">United Arab Emirates</option>
                          <option value="United Kingdom">United Kingdom</option>
                          <option value="United States">United States</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="user-role">User Role</label>
                        <select id="user-role" class="form-select">
                          <option value="subscriber">Subscriber</option>
                          <option value="editor">Editor</option>
                          <option value="maintainer">Maintainer</option>
                          <option value="author">Author</option>
                          <option value="admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success me-sm-3 me-1 data-submit">Submit</button>
                    <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>


<style lang="scss" scoped>

</style>
