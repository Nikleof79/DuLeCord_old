let arr = ['a'];
let obj = {a:'a'};

function is_object(target) {
    return typeof target === 'object' && !Array.isArray(target) && target !== null;
}

console.log(is_object(arr));
console.log(is_object(obj));