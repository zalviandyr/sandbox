void main(List<String> args) {
  String word = 'Air Bnb';

  List<String> words = word.split(' ');
  String initial = words.map((e) => e[0]).join('');
  print(initial);
}