@extends('layouts.default')
@section('main_content')
<div class="row mb-3">
  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Customers</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">40,000</div>
            <div class="mt-2 mb-0 text-muted text-xs">
              <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
              <span>Since last month</span>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Earnings (Annual) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Rewards Used</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">6500000</div>
            <div class="mt-2 mb-0 text-muted text-xs">
              <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
              <span>Since last years</span>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-shopping-cart fa-2x text-success"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- New User Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">New Vendors</div>
            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">366</div>
            <div class="mt-2 mb-0 text-muted text-xs">
              <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
              <span>Since last month</span>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-info"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Income</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">780k</div>
            <div class="mt-2 mb-0 text-muted text-xs">
              <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
              <span>Since last month</span>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-warning"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <!-- Invoice Example -->
  <div class="col-xl-8 col-lg-7 mb-4">
    <div class="card">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Latest Cusmtomers Registered</h6>
        <a class="m-0 float-right btn btn-danger btn-sm" href="#">View All <i
            class="fas fa-chevron-right"></i></a>
      </div>
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th>Order ID</th>
              <th>Customer</th>
              <th>Address</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><a href="#">RA0449</a></td>
              <td>Udin Wayang</td>
              <td>Nasi Padang</td>
              <td><span class="badge badge-success">Delivered</span></td>
              <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
            </tr>
            <tr>
              <td><a href="#">RA5324</a></td>
              <td>Jaenab Bajigur</td>
              <td>Gundam 90' Edition</td>
              <td><span class="badge badge-warning">Shipping</span></td>
              <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
            </tr>
            <tr>
              <td><a href="#">RA8568</a></td>
              <td>Rivat Mahesa</td>
              <td>Oblong T-Shirt</td>
              <td><span class="badge badge-danger">Pending</span></td>
              <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
            </tr>
            <tr>
              <td><a href="#">RA1453</a></td>
              <td>Indri Junanda</td>
              <td>Hat Rounded</td>
              <td><span class="badge badge-info">Processing</span></td>
              <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
            </tr>
            <tr>
              <td><a href="#">RA1998</a></td>
              <td>Udin Cilok</td>
              <td>Baby Powder</td>
              <td><span class="badge badge-success">Delivered</span></td>
              <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="card-footer"></div>
    </div>
  </div>
  <!-- Message From Customer-->
  <div class="col-xl-4 col-lg-5 ">
    <div class="card">
      <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-light">Latest Transactions</h6>
      </div>
      <div>
        <div class="customer-message align-items-center">
          <a class="font-weight-bold" href="#">
            <div class="text-truncate message-title">Customer ID 9845645 used 300 Reward Points at Nayantara Supermarket.</div>
            <div class="small text-gray-500 message-time font-weight-bold">300 Points</div>
          </a>
        </div>
        <div class="customer-message align-items-center">
          <a href="#">
            <div class="text-truncate message-title">Customer ID 9845645 used 3000 Reward Points at Matrix Lab.
            </div>
            <div class="small text-gray-500 message-time">3000 Points</div>
          </a>
        </div>
        <div class="customer-message align-items-center">
          <a class="font-weight-bold" href="#">
            <div class="text-truncate message-title">Customer ID 9845645 used 500 Reward Points at Vishal.
            </div>
            <div class="small text-gray-500 message-time font-weight-bold">500 Points</div>
          </a>
        </div>
        <div class="customer-message align-items-center">
          <a class="font-weight-bold" href="#">
            <div class="text-truncate message-title">Customer ID 9845645 used 10000 Reward Points at JDDS Beltola.
              ducimus qui blanditiis
            </div>
            <div class="small text-gray-500 message-time font-weight-bold">10000 Points</div>
          </a>
        </div>
        <div class="card-footer text-center">
          <a class="m-0 small text-primary card-link" href="#">View All <i
              class="fas fa-chevron-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
@stop