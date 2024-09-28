/*
 const searchbar = document.getElementById('filter');
 const results= document.getElementById('serach-results');
 searchbar.addEventListener('input',(events)=> {
    const term = events.target.value;
    if(term .length> 2){
        //fetch suggesstion from the server 
        const url ="../php/products.php?TERM="+term;
        window.location.href= url;
    ;
        //create a new form element
        const form = document.createElement('form');
        form.method= 'GET';
        form.action= url;

        //create a hidden input field to get erching term
        const input= document.createElement('input');
        input.type = 'hidden';
        input.name='serach_term';
        input.value ='Search';

        //append the input field to the form
        form.appendChild('input');

        //create new script element
        const scriptelement= document.createElement('script');
        scriptelement.src='url';

        //apend the created form  and the script to the body
        document.body.appendChild(form);
        document.body.appendChild(scriptelement);

        //remove the the created form and script element
        scriptelement.onload=() =>{
            form.remove();
            scriptelement.remove();
        
        //suggestions
        const suggestions =window.suggestions;
        results.innerHTML='';
        suggestions.forEach(suggestion => {
            const list= document.createElement('li');
            list.textContent = suggestion;
            list.addEventListener('click',() =>{
                searchbar.value= suggestion;
                results.style.display='none';
            });
            results.appendChild(list);
        });
        results.style.display='block';
            
        };

        //submit the form
        form.submit();
    }
    else{
        results.style.display='none';
    }
    
});
document.addEventListener('click',(events)=>{
if(!searchbar.contains(events.target) && !results.contains(events.target)){
    results.style.display='none';
}
});
        */


              
