const removed = "SISTEM PENGECEKAN KEMIRIPAN TUGAS MAHASISWA MENGGUNAKAN ALGORITMA RABIN-KARP DAN JARO-WINKLER".replace(/[\W_]/g, "").toLocaleLowerCase();
const text = "sistempengecekankemiripantugasmahasiswamenggunakanalgoritmarabinkarpjarowinkler";

console.log(removed);
console.log(text.replace(removed, ''));