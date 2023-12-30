// btn click effects
let btnClickElements = document.querySelectorAll(".btn-click")
btnClickElements.forEach( btn =>{
    btn.addEventListener('mousedown',()=>{
        // look for an active 
        btnClickElements.forEach( element =>{
            if (element.classList.contains('bg-light-green')){
                element.classList.replace('bg-light-green', 'bg-white')
            }
        })
        // btn.classList.remove('shadow-sm')
    })
    btn.addEventListener('mouseup',()=>{
        // btn.classList.add('shadow-sm')
        btn.classList.replace('bg-white', 'bg-light-green')
    })
})

