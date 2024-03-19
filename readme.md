# Simple test task for Ron to integrate Amazon SP API into custom PHP project using Amazon SP API SDK

## The SDK link is: https://github.com/amazon-php/sp-api-sdk .

### Notes

* As it's very late time, I create the project very simply, it'll need many improvemts in PHP architecture and in some codes.

* I didn't add any comments to codes, because as Uncle Bob says, the best comment is the comment you don't have to write.

* At the moment I send two requests: to FBA invetory API to get all the inventory data and to FBA outbound API o get fulfillment orders of last 12 months.

### Installation process

* Clone the codes from the repo.

* Open the terminal in the root directory of the project and run `composer install`.

* Create `config/app.local.php` file based on `config/app.php` and fill Amazon SP API credentials there.

* Create a virtual host for the project and run it on a browser

### Thank you

Maybe I forgot some things, maybe some things aren't so good, but I hope you'll understand, as I worked in the night and it's already 6 am here.
