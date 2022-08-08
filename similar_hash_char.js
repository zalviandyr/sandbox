const string = 'sayaadalahmanusia';
const value = 4;
const basis = 397;
const modulo = 1001;

// const result = ['ardi', 'emba'];
// const listHash = [];

// for (const elm of result) {
//     let hash = 0;
//     for (let i = 0; i < elm.length; i++) {
//         const count = (elm.length - 1) - i;
//         const char = elm[i];

//         const charHash = char.charCodeAt(0) * basis ** count;
//         hash += charHash;
//     }


//     hash %= modulo;
//     listHash.push(hash.toString());
// }

// const listHash = ['922', '932'];
// const transpos1 = ['0', '0', '0']
// const transpos2 = ['0', '0', '0']
// const listHash = ['tidyr', 'tiban'];
// const helper1 = ['0', '0', '0', '0', '0']
// const helper2 = ['0', '0', '0', '0', '0']
const listHash = ['rembulan', 'rumbelan'];
const helper1 = ['0', '0', '0', '0', '0', '0', '0', '0']
const helper2 = ['0', '0', '0', '0', '0', '0', '0', '0']
// const listHash = ['rembulan', 'lembu'];
// const helper1 = ['0', '0', '0', '0', '0', '0', '0', '0']
// const helper2 = ['0', '0', '0', '0', '0']
let matched = 0;

for (let i = 0; i < listHash[0].length; i++) {
    const hash1 = listHash[0][i];
    const hash2 = listHash[1][i];

    if (hash1 === hash2 && helper2[i] === '0') {
        helper1[i] = '1';
        helper2[i] = '1';
        matched += 1;
    }
}

// for (let i = 0; i < listHash[0].length; i++) {
//     const hash1 = listHash[0][i];

//     for (let j = i; j < listHash[1].length; j++) {
//         const hash2 = listHash[1][j];

//         if (hash1 === hash2 && helper2[j] === '0') {
//             helper1[i] = '1';
//             helper2[j] = '1';
//             matched += 1;
//             break;
//         }
//     }
// }

let transpos = 0;
let tip = 0;
for (let i = 0; i < helper1.length; i++) {

    if (helper1[i] === '1') {
        while (helper2[tip] === '0') {
            tip += 1;
        }

        const temp1 = helper1[i];
        const temp2 = helper2[tip += 1];

        if (temp1 != temp2) {
            transpos += 1;
        }
    }
}

console.log(matched)
console.log(transpos)
console.log(helper1)
console.log(helper2)