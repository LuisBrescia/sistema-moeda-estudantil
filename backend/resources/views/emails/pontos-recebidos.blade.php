<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pontos Recebidos</title>
    <style>
        body,
        table,
        td,
        a {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
        }

        table {
            border-spacing: 0;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        a {
            color: #1a73e8;
            text-decoration: none;
        }

        .email-wrapper {
            background-color: #f4f6f8;
            padding: 40px 0;
        }

        .email-container {
            width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #f7a7a0;
            color: #ffffff;
            padding: 30px;
            border-radius: 8px 8px 0 0;
            text-align: center;
            background-image: url('https://giphy.com/gifs/lazy-corgi-1oBwBVLGoLteCP2kyD');
            background-size: cover;
            background-position: center;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .email-body {
            padding: 30px;
            color: #555555;
            font-size: 16px;
            line-height: 1.5;
        }

        .email-body p {
            margin-bottom: 15px;
        }

        .email-footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #888888;
            border-radius: 0 0 8px 8px;
        }

        .email-footer a {
            color: #1a73e8;
        }

        .cta-button {
            background-color: #ffffff;
            color: #000000;
            padding: 10px 20px;
            text-align: center;
            border-radius: 4px;
            display: inline-block;
            font-size: 16px;
            text-decoration: none;
            border: 2px solid #000000;
        }

        .cta-button:hover {
            background-color: #000000;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-container">
            <div class="email-header" style="background-color: #ffa94d; color: #ffffff; padding: 30px; border-radius: 8px 8px 0 0; text-align: center; background-image: url('https://giphy.com/gifs/lazy-corgi-1oBwBVLGoLteCP2kyD'); background-size: cover; background-position: center;">
                <h1>Pontos Recebidos</h1>
            </div>

            <div class="email-body" style="padding: 30px; color: #555555; font-size: 16px; line-height: 1.5;">
                <p>Olá, {{ $aluno->nome }}!</p>
                <p>Você recebeu <strong>{{ $quantidade }} pontos</strong> recentemente. Agora, seu saldo de pontos é de <strong>{{ $aluno->saldo }} pontos</strong>.</p>
                <p>Continue aproveitando nossas vantagens e não perca as oportunidades para acumular ainda mais pontos!</p>
                <a href="https://aravault2.vercel.app" class="cta-button">Acessar sua conta</a>
                <p>Atenciosamente,<br>Equipe AraVault!</p>
            </div>
            <div class="email-footer" style="background-color: #f1f1f1; text-align: center; padding: 20px; font-size: 12px; color: #888888; border-radius: 0 0 8px 8px;">
                <p>Se você tiver alguma dúvida, entre em <a href="mailto:support@{{ config('app.name') }}.com">contato conosco</a>.</p>
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.</p>
            </div>
        </div>
    </div>
</body>

</html>