<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class="card">
  <div class="card-body">
  <form method="get" action="{{route('search_customer')}}">
    <div class="form-group" >
      <label for="email">Search Customer:</label>
      <input type="text" class="form-control" id="text" placeholder="Enter customer name" name="name">
    </div>
    <button type="submit" class="btn btn-primary">Search</button>
  </form>
  </div>
  </div>
</div>
<form method="post" action="{{route('pay_payment')}}">
@csrf
<div class="container">
@php
$total_due = 0;
@endphp
@if($customer != null)

<table class="table table-bordered">
    <thead>
      <tr>
        <th>Check</th>
        <th>Date</th>
        <th>invoice</th>
        <th>Total Amount</th>
        <th>Paid Amount</th>
        <th>Due Amount</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($customer->order as $user)
      <tr>
        <td>
        <input type="checkbox" name="serail[]" value="{{$user->id}}">
        </td>
        <td>
        {{$user->date}}
        </td>
        <td>
        {{$user->invoice}}
        </td>
        <td>
        {{$user->grand_total}}
        </td>

        <td>
        {{$user->payment->sum('paid_amount')}}
        </td>

        <td>

        @php
        $due = $user->grand_total - $user->payment->sum('paid_amount');

        $total_due += $due 
        @endphp
        {{$due}}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

</div>
<div class="container">
<div class="d-flex justify-content-between mb-3">
    <div class="p-2">Due: {{$total_due}}</div>
    <div class="p-2">Receiva ble Due: </div>
    <div class="p-2">
    <div class="w-100">
    Receipt Amount:  <input type="text" name="payment" required>
    </div>
    <div class="w-100">Remaing: <span id="remain">{{$total_due}}</span></div>
</div>


</div>

  </div>
  
  <input type="hidden" name="customer" value="{{$customer->id}}">
  
  <button type="submit" class="btn btn-primary">Save</button>
  @endif
  </form>
</body>
</html>
