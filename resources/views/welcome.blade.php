<head>
    <title>
        Sojickshop
    </title>
    <style>
        body,html {
            margin: 0px;
            padding: 0px;
        }
        .container {
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background: #30326E;
        }
        .container img {
            width: 50vw;
            height: 50vw;
            animation-name: rotateMe;
            animation-duration: 10s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }
        @keyframes rotateMe{
            100% {
                transform: rotate(360deg);
            }
        }
        h1{
            font-family: sans-serif;
            color: #B7FBE1;
        }

        @media screen and (min-width:600px){
            .container img {
                width:20vw;
                height:20vw;
            }
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div>
            <img src="/logo/square.png" alt="logo of shop">
            
        </div>
        <h1>
            COMMING SOON
        </h1>
    </div>
</body>