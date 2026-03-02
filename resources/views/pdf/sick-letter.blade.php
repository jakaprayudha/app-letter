<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
</head>

<body>
   <h2>SURAT KETERANGAN SAKIT</h2>
   <p>Dokter : {{$data->doctor->name}}</p>
   <p>Poliklinik : {{$data->poli->policlinic}}</p>
   <p>Nama Pasien : {{$data->patient_name}}</p>
   <p>Tanggal : {{$data->start_date}} s/d {{$data->end_date}}</p>
   <br>
   <p>Diagnosa : </p>
   <p>{{$data->diagnosis}}</p>
   <br>
   <p>Dokter</p>
   <br>
   <p>{{$data->doctor->name}}</p>
</body>

</html>