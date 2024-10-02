let data = fetch('http://localhost/handlers/api/get_info_about.php?target=nikman79',{
    method:'POST',
    body:JSON.stringify({
        target:'nikman79'
    })
}).then((response)=>{
    return response.json();
}).then(data=>{
    console.log(data);  
})