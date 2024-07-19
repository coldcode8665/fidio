

document.addEventListener('livewire:navigated', () => { 
    let tab = document.querySelector(".tab");
    let tabcontent = document.querySelector(".tabcontent");

    for(let i = 0; i < tabcontent.children.length; i++){
        tabcontent.children[i].classList.add("hidden");
    }
    tabcontent.children[0].classList.remove("hidden");

    function tabreset(){
        for(let i = 0; i < tab.children.length; i++){
            tab.children[i].classList.remove('bg-gray-200');
        }
    }
    function tabcontentreset(){
        for(let i = 0; i < tabcontent.children.length; i++){
            tabcontent.children[i].classList.add("hidden");
        }
    }

    for(let i = 0; i < tab.children.length; i++){
        tab.children[i].addEventListener("click",function(){
            tabreset();
            tabcontentreset()
            tab.children[i].classList.add('bg-gray-200');
            tabcontent.children[i].classList.remove("hidden");
           
     })
    }
})
 
