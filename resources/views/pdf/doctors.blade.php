<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <title>Doctors PDF</title>

   <style>
      body {
         font-family: sans-serif;
         font-size: 12px;
      }

      table {
         width: 100%;
         border-collapse: collapse;
      }

      table,
      th,
      td {
         border: 1px solid black;
      }

      th,
      td {
         padding: 6px;
         text-align: left;
      }

      th {
         background: #f2f2f2;
      }
   </style>
</head>

<body>

   <h2>Data Doctors</h2>

   <table>
      <thead>
         <tr>
            <th>No</th>
            <th>Name</th>
            <th>NIP</th>
            <th>SIP</th>
            <th>Category</th>
            <th>Poli</th>
         </tr>
      </thead>
      <tbody>
         @foreach($doctors as $index => $doctor)
         <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $doctor->name }}</td>
            <td>{{ $doctor->nip }}</td>
            <td>{{ $doctor->sip }}</td>
            <td>{{ $doctor->category }}</td>
            <td>{{ $doctor->poli }}</td>
         </tr>
         @endforeach
      </tbody>
   </table>

</body>

</html>