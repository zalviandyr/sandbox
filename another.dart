import 'dart:convert';

main(List<String> args) {
  var text = '{"data": "heyaaa ma frend"}';
  var encode = json.encode(text);
  var decode = json.decode(encode);

  print(decode['data']);
}
