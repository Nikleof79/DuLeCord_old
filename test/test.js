function range(from,to) { 
    let x = [];
    for (let i = from; i < to; i++) {
        x.push(i);
    }
    return range;
}

range(12,24).forEach(element => {
    let str = (element*(element-2)).toString();
    let x = 0;
    str.split('',(num)=>{
        x += Number(num);
    })
    
});