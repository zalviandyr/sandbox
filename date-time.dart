import 'dart:convert';

import 'package:intl/intl.dart';

void main(List<String> args) {
  dynamic json = jsonDecode('''[
    {"tanggal":"2021-11-09 14:31"},
    {"tanggal":"2021-10-08 15:01"},
    {"tanggal":"2021-16-08 18:04"}
  ]''');
  List<String> formattedDates = [];

  for (var item in json) {
    formattedDates.add(formatDate(item['tanggal']));
  }
  print(formattedDates);

  String now = DateFormat('ddMMy').format(DateTime.now());
  print(now);
}

String formatDate(String date) {
  // ubah data dari db ke datetime
  DateFormat parser = DateFormat('yyyy-MM-dd HH:mm');
  DateTime dateTime = parser.parse(date);

  // format data yang sudah di parse
  DateFormat formatter = DateFormat('dd MMMM yyyy - HH:mm');

  return formatter.format(dateTime);
}
