const string = 'sayaadalahmanusia';
const value = 4;
// const modulo = 5001;
// const basis = 7;
const basis = 397;
const modulo = 1001;

// const result = [];
// let start = 0;
// let end = value;
// for (let i = 0; i < string.length; i++) {
//     const slice = string.slice(start, end);
//     if (slice.length === value) {
//         result.push(slice);
//     }

//     start = i + 1;
//     end = start + value;
// }

const result = ['ardi', 'emba'];

for (const elm of result) {
    let hash = 0;
    for (let i = 0; i < elm.length; i++) {
        const count = (elm.length - 1) - i;
        const char = elm[i];

        const charHash = char.charCodeAt(0) * basis ** count;
        hash += charHash;
    }


    hash %= modulo;
    console.log(hash);
}

// const texts = ['saya', 'adalah', 'manusia', 'biasa', 'yang', 'biasanya'];
// const questions = ['adalah', 'biasa'];

// for (let i = 0; i < texts.length; i++) {
//     const text = texts[i];

//     for (let j = 0; j < questions.length; j++) {
//         const question = questions[j];

//         if (text === question) {
//             texts.splice(i, 1);
//         }
//     }
// }

// console.log(texts);