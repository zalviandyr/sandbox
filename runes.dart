void main(List<String> args) {
  String words = 'rembu';

  for (var item in words.split('')) {
    print(item.runes);
  }
}
