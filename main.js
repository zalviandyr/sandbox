const data = '1;Ucup;1A\n2;Mario;2B'
console.log(data)

const dataArray = data.split('\n');
const result = [];
for (let i = 0; i < dataArray.length; i++) {
    const itemArray = dataArray[i].split(';');
    const temp = [];

    for (let j = 0; j < itemArray.length; j++) {
        temp.push(itemArray[j]);
    }

    result.push(temp);
}
console.log(result);
console.log('Urut: ' + result[0][0]);
console.log('Nama: ' + result[0][1]);