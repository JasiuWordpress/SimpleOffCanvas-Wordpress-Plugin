const klasy = SimpleOffCanvasData.klasy;
const klas_array = [];
const klas_to_use_array = [];

const open_btns = SimpleOffCanvasData.open_btns;
const close_btns = SimpleOffCanvasData.close_btns;




const offcanvas_function = function(array){

    let i = 0;

    array.forEach(ar => {

        let offcanvas_wrap = document.createElement('div');
        offcanvas_wrap.classList.add('offcanvas_wrap_'+klas_to_use_array[i]);
        offcanvas_wrap.setAttribute('aria-hidden','true');

        const newDiv = document.createElement('div');
        newDiv.classList.add('open_'+klas_to_use_array[i])

        let classname = klas_to_use_array[i];
        
        if(open_btns[classname]){
             newDiv.textContent = open_btns[classname];
        }else{
            newDiv.textContent = 'Open';
        }

        const close_btn = document.createElement('div');
        close_btn.classList.add('close_'+klas_to_use_array[i])

         if(close_btns[classname]){
             close_btn.textContent = close_btns[classname];
        }else{
            close_btn.textContent = 'Close';
        }
 
      

        ar.parentNode.insertBefore(newDiv, ar);

        let offcanvas_body = document.createElement('div');
        offcanvas_body.classList.add('offcanvas_body_'+klasy[i])
        offcanvas_body.appendChild(ar);
        
        offcanvas_wrap.appendChild(offcanvas_body);
        offcanvas_wrap.prepend(close_btn);
        ar.classList.add('hide-before');

        ar.classList.remove(klas_to_use_array[i]);
        document.body.appendChild(offcanvas_wrap);

        close_btn.addEventListener('click',() => {
            att =  offcanvas_wrap.getAttribute('aria-hidden');
            if(att == 'true'){
             offcanvas_wrap.setAttribute('aria-hidden','false');
             }else{
                  offcanvas_wrap.setAttribute('aria-hidden','true');
             }
        })

        newDiv.addEventListener('click',() => {
           att =  offcanvas_wrap.getAttribute('aria-hidden');
            if(att == 'true'){
             offcanvas_wrap.setAttribute('aria-hidden','false');
             }else{
                  offcanvas_wrap.setAttribute('aria-hidden','true');
             }

             i++;//nastepna klasa...  
        })

    });
}


document.addEventListener('DOMContentLoaded',() => {
    for (klasa of klasy) {
        let item = document.querySelector('.'+klasa)
        if(item){
        klas_array.push(item);
        klas_to_use_array.push(klasa); 
        }
    }
    setTimeout(() => {
          offcanvas_function(klas_array);
    }, 500);
  
})

