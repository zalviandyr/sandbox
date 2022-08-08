function jaro_distance(s1, s2) {
    // If the strings are equal
    // if (s1 == s2)
    //     return 1.0;

    // Length of two strings
    var len1 = s1.length,
        len2 = s2.length;

    // Maximum distance upto which matching
    // is allowed
    var max_dist = Math.floor(Math.max(len1, len2) / 2) - 1;
    console.log(`max_dist ${max_dist}`);

    // Count of matches
    var match = 0;

    // Hash for matches
    var hash_s1 = Array(s1.length).fill(0);
    var hash_s2 = Array(s2.length).fill(0);

    // Traverse through the first string
    for (var i = 0; i < len1; i++) {

        // Check if there is any matches
        for (var j = Math.max(0, i - max_dist); j < Math.min(len2, i + max_dist + 1); j++)

            // If there is a match
            if (s1[i] == s2[j] && hash_s2[j] == 0) {
                hash_s1[i] = 1;
                hash_s2[j] = 1;
                match++;
                break;
            }
    }

    console.log(hash_s1);
    console.log(hash_s2);
    console.log(`match ${match}`)

    // If there is no match
    if (match == 0)
        return 0.0;

    // Number of transpositions
    var t = 0;

    var point = 0;

    // Count number of occurrences
    // where two characters match but
    // there is a third matched character
    // in between the indices
    for (var i = 0; i < len1; i++) {
        // console.log(hash_s1[i] == 1);
        if (hash_s1[i] == 1) {

            // Find the next matched character
            // in second string
            while (hash_s2[point] == 0) {
                console.log(`YY ${hash_s2[point]} (${point})`);
                point++;
            }

            const temp1 = s1[i];
            const temp2 = s2[point++];
            if (temp1 != temp2) {
                console.log(`XX ${temp1} != ${temp2} \t (${i}) (${point})`);
                t++;
            }
        }
    }

    console.log(`before transpose ${t}`)
    t /= 2;
    console.log(`transpose ${t}`)

    // Return the Jaro Similarity
    return ((match) / (len1)
        + (match) / (len2)
        + (match - t) / (match))
        / 3.0;
}

// Driver code
// var s1 = "CRATE", s2 = "TRACE";
// var s1 = "arnab", s2 = "raanb";
// var s1 = "MARTHA", s2 = "MARHTA";
// var s1 = "MARTHA", s2 = "RAMHTA";
// var s1 = "rembulan", s2 = "umrelan";
// var s1 = "tidyr", s2 = "tiban";
// var s1 = "rembulan", s2 = "lembu";
// var s1 = "rembulan", s2 = "rumbelan";
// var s1 = "rembulan", s2 = "rembulan";
var s1 = 'Jarumledak', s2 = 'Juramledak';

console.log(jaro_distance(s1, s2));