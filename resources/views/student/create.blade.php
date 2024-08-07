<base href="/">
<x-layouts>

    <style>
        .student-card {
            background-image: url('assets/images/background-studentCard.jpeg');
            z-index: -1;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            font-weight: bold;
        }

        .student-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            opacity: 0.8;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            z-index: -1;
        }

        .student-photo {
            width: 130px;
            height: 130px;
            object-fit: cover;
        }

        .logo {
            width: 180px;
            height: 180px;
            background-image: url('assets/images/logo-studentCard.jpg');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            opacity: 0.8;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        .student-card-infos {

            font-size: 16px;

        }
    </style>

    @livewire('create-student')


</x-layouts>
