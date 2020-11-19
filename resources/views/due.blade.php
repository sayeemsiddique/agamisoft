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
  <h2>Customer Due</h2>         
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Customer Name</th>
        <th>Total Payable</th>

        <th>Total Paid</th>
        <th>Total Due</th>

      </tr>
    </thead>
    <tbody>
    @foreach ($customer as $user)
      <tr>
        <td>{{$user->customer_fname}}</td>
        <td> 
        @php
        $grand = 0;
        @endphp
         @if(count($user->order) > 0) 
         @php 
            $grand = $user->order->sum('grand_total'); 
         @endphp 
         @endif
         {{$grand}}
         </td>
        <td>
        @php $total = 0; @endphp
        @if(count($user->order) > 0) 
        @php
        
        foreach ($user->order as $key => $value) {
            $total += $value->payment->sum('paid_amount');
        }

        @endphp
        {{$total}}
        @endif
        </td>

        <td>
        {{ $grand - $total}}
        </td>

      </tr>
      @endforeach
    </tbody>
  </table>
</div>

</body>
</html>
