void main(List<String> args) {
  List<Map<String, String>> maps = [
    {"name": "Pulsa", "description": "lorem ipsun"},
    {"name": "Paket Data", "description": "lorem ipsun"},
    {"name": "Pajak", "description": "lorem ipsun"},
  ];

  List<String> filter = ['Pulsa', 'Paket Data'];

  List<Map<String, String>> result =
      maps.where((element) => filter.contains(element['name'])).toList();

  print(result);
}
