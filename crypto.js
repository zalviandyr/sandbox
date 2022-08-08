const CryptoJs = require('crypto-js');

var hash = CryptoJs.SHA256("Message");
// var base64 = CryptoJs.enc.Base64.stringify(hash.toString());
console.log(hash.toString(CryptoJs.enc.Hex));