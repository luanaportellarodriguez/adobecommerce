<?php
namespace MinhaLoja\Strava\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Index implements HttpGetActionInterface
{
    private ResultFactory $resultFactory;

    public function __construct(ResultFactory $resultFactory)
    {
        $this->resultFactory = $resultFactory;
    }

    public function execute()
    {
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Strava Integration</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <style>
                body { 
                    margin: 0; 
                    padding: 20px; 
                    font-family: Arial, sans-serif; 
                }
                .container {
                    max-width: 100%;
    height: 100vh;
    width: 100vw;
                }
                iframe { 
                    width: 100%; 
                    height: 100%; 
                    border: 1px solid #ddd; 
                    border-radius: 8px;
                }
                .error-message {
                    padding: 20px;
                    background: #f8f9fa;
                    border: 1px solid #dee2e6;
                    border-radius: 8px;
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <iframe src="https://www.strava.com" 
                        frameborder="0" 
                        allowfullscreen
                        sandbox="allow-scripts allow-same-origin allow-forms allow-popups"
                        onerror="showError()">
                </iframe>
            </div>
            
            <script>
                function showError() {
                    document.querySelector(".container").innerHTML = 
                        `<div class="error-message">
                            <h3>Não foi possível carregar o Strava</h3>
                            <p>O site pode estar bloqueando a incorporação via iframe.</p>
                            <p><a href="https://www.strava.com.br" target="_blank">Abrir Strava em nova aba</a></p>
                        </div>`;
                }
            </script>
        </body>
        </html>';

        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $result->setContents($html);
        return $result;
    }
}