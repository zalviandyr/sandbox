class Env {
  Map<String, dynamic> _data = {};

  Env._internal();

  static final Env _instance = Env._internal();

  static Env get instance => _instance;

  set(String key, String value) {
    _data[key] = value;
  }

  get(String key) {
    return _data[key];
  }
}

main() {
  Env env = Env.instance;
  env.set('api', 'asdasd');
  print(env.get('api'));

  Env env2 = Env.instance;
  print(env2.set('api', 'xx'));
  print(env2.get('api'));
  print(env.get('api'));
}
