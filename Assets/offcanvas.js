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
 
      
        let parent_ar = ar.parentNode;
        ar.parentNode.insertBefore(newDiv, ar);

        let offcanvas_body = document.createElement('div');
        offcanvas_body.classList.add('offcanvas_body_'+klasy[i])
        offcanvas_body.appendChild(ar);
        
        offcanvas_wrap.appendChild(offcanvas_body);
        offcanvas_wrap.prepend(close_btn);
        ar.classList.add('hide-before');

        ar.classList.remove(klas_to_use_array[i]);
         parent_ar.appendChild(offcanvas_wrap);

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


const  offcanvas_function_undo = function(array) {
    let i = 0;
    array.forEach(ar => {
        const classname = klas_to_use_array[i];

        // znajdź open button
        const openBtn = document.querySelector('.open_' + classname);
        if (openBtn) {
            const originalParent = openBtn.parentNode;

            // znajdź wrap
            const wrap = document.querySelector('.offcanvas_wrap_' + classname);
            if (wrap) {
                const body = wrap.querySelector('.offcanvas_body_' + klasy[i]);
                if (body && body.contains(ar)) {
                    // przywróć element przed open button
                    originalParent.insertBefore(ar, openBtn);
                }

                // usuń wrap
                wrap.remove();
            }

            // usuń open button
            openBtn.remove();

            // przywróć oryginalną klasę
            ar.classList.add(classname);
            ar.classList.remove('hide-before');
        }

        i++;
    });
}




document.addEventListener('DOMContentLoaded',() => {
      let popup_created = false;
      let klasy_array = Array.from(klasy);//wymuszenie array'a dla mozliwosci petli for of
    for (klasa of klasy_array) {
        let item = document.querySelector('.'+klasa)
        if(item){
        klas_array.push(item);
        klas_to_use_array.push(klasa); 
        }
    }
    if (window.innerWidth <= 768) {
    setTimeout(() => {
          offcanvas_function(klas_array);
    }, 500);
      popup_created = true;
  }
  window.addEventListener('resize', () => { 
    if (window.innerWidth <= 768 && popup_created != true) {
         setTimeout(() => {
          offcanvas_function(klas_array);
         }, 500);
           popup_created = true;
    }

     if (window.innerWidth >= 768 && popup_created == true) {
        offcanvas_function_undo(klas_array);
          popup_created = false;
    }

  })
  
})

