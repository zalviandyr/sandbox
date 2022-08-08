main() {
  List<String> list = ['a', 'b', 'c', 'd', 'e'];

  String keyword = 'f';
  List<String> result = list.where((element) => element == keyword).toList();

  String singleResult = list.singleWhere(
    (element) => element == keyword,
    orElse: () => null,
  );

  print(singleResult);
  print(list);
  print(result);
}
