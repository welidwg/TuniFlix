@include('Dash/mainNav')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} - Movies List</title>

</head>

<body>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="m-0 fw-bold" style="color: rgb(221,21,44);">Users List</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label
                            class="form-label"></label></div>
                </div>
                <div class="col"><input type="search" class="form-control form-control-sm"
                        aria-controls="dataTable" placeholder="Search"></div>
            </div>
            <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Duration</th>
                            <th>Links Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img class="rounded-circle me-2" width="30" height="30"
                                    src="../assets1/img/avatars/avatar1.jpeg">Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008/11/28</td>
                            <td class="d-inline-flex" style="padding: 8px;width: 96.766px;"><a class="btn btn-warning"
                                    role="button" style="width: 40.6875px;margin-right: 6px;"><i
                                        class="fas fa-tools"></i></a><button class="btn btn-danger" type="button"><i
                                        class="fas fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td><img class="rounded-circle me-2" width="30" height="30"
                                    src="../assets1/img/avatars/avatar2.jpeg">Angelica Ramos</td>
                            <td>Chief Executive Officer(CEO)</td>
                            <td>London</td>
                            <td>47</td>
                            <td>2009/10/09<br></td>
                            <td>$1,200,000</td>
                        </tr>
                        <tr>
                            <td><img class="rounded-circle me-2" width="30" height="30"
                                    src="../assets1/img/avatars/avatar3.jpeg">Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009/01/12<br></td>
                            <td>$86,000</td>
                        </tr>
                        <tr>
                            <td><img class="rounded-circle me-2" width="30" height="30"
                                    src="../assets1/img/avatars/avatar4.jpeg">Bradley Greer</td>
                            <td>Software Engineer</td>
                            <td>London</td>
                            <td>41</td>
                            <td>2012/10/13<br></td>
                            <td>$132,000</td>
                        </tr>
                        <tr>
                            <td><img class="rounded-circle me-2" width="30" height="30"
                                    src="../assets1/img/avatars/avatar5.jpeg">Brenden Wagner</td>
                            <td>Software Engineer</td>
                            <td>San Francisco</td>
                            <td>28</td>
                            <td>2011/06/07<br></td>
                            <td>$206,850</td>
                        </tr>
                        <tr>
                            <td><img class="rounded-circle me-2" width="30" height="30"
                                    src="../assets1/img/avatars/avatar1.jpeg">Brielle Williamson</td>
                            <td>Integration Specialist</td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2012/12/02<br></td>
                            <td>$372,000</td>
                        </tr>
                        <tr>
                            <td><img class="rounded-circle me-2" width="30" height="30"
                                    src="../assets1/img/avatars/avatar2.jpeg">Bruno Nash<br></td>
                            <td>Software Engineer</td>
                            <td>London</td>
                            <td>38</td>
                            <td>2011/05/03<br></td>
                            <td>$163,500</td>
                        </tr>
                        <tr>
                            <td><img class="rounded-circle me-2" width="30" height="30"
                                    src="../assets1/img/avatars/avatar3.jpeg">Caesar Vance</td>
                            <td>Pre-Sales Support</td>
                            <td>New York</td>
                            <td>21</td>
                            <td>2011/12/12<br></td>
                            <td>$106,450</td>
                        </tr>
                        <tr>
                            <td><img class="rounded-circle me-2" width="30" height="30"
                                    src="../assets1/img/avatars/avatar4.jpeg">Cara Stevens</td>
                            <td>Sales Assistant</td>
                            <td>New York</td>
                            <td>46</td>
                            <td>2011/12/06<br></td>
                            <td>$145,600</td>
                        </tr>
                        <tr>
                            <td><img class="rounded-circle me-2" width="30" height="30"
                                    src="../assets1/img/avatars/avatar5.jpeg">Cedric Kelly</td>
                            <td>Senior JavaScript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012/03/29<br></td>
                            <td>$433,060</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Name</strong></td>
                            <td><strong>Position</strong></td>
                            <td><strong>Office</strong></td>
                            <td><strong>Age</strong></td>
                            <td><strong>Start date</strong></td>
                            <td><strong>Salary</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite"></p>
                </div>
                <div class="col-md-6">
                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#"
                                    aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                            <li class="page-item active" style="background: var(--bs-red);"><a class="page-link"
                                    href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span
                                        aria-hidden="true">»</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</body>
</div>
</div>

@include('Dash/footer')

</html>