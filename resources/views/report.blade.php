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
@php
$total_due = 0;
@endphp
@if($report != null)

<table class="table table-bordered">
    <thead>
      <tr>
        <th>Invoice Id</th>
        <th>Paid</th>
        <th>Due</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($report as $user)
      <tr>
        <td>
        {{$user->invoice}}
        </td>
        <td>
        {{$user->payment->sum('paid_amount')}}
        </td>
        <td>
        {{$user->grand_total - $user->payment->sum('paid_amount')}}
        </td>
        
      </tr>
      @endforeach
    </tbody>
  </table>
@endif
</div>

  </div>
</body>
</html>
