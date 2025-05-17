
document.addEventListener('DOMContentLoaded',(event) => {
   
    const add_new_btn = document.querySelector('.addmore');
    const plugin_body = document.querySelector('.simpleoffcanvas_parent');
    let $html = `<input type="text" name="simpleoffcanvas_class[]" placeholder="Write your's div class without a dot.">`;
    let no_divs_p = document.querySelector('.no_divs_p');

    const delete_btns = document.querySelectorAll('.delete_offcanvas');

    if(delete_btns){
        delete_btns.forEach(dbtn =>{
            dbtn.addEventListener('click', () => {
                let parent = dbtn.closest('.classes_wrap');
                parent.remove();
            })
        })
    }

    if(add_new_btn){
        add_new_btn.addEventListener('click', (event) => {
             event.preventDefault();

            //usuwanie p co mowi ze nie ma divow
            if(no_divs_p){
                no_divs_p.remove();
            }



            let $input = document.createElement('div');
            $input.classList.add('simpleoffcanvas_custom_div_menu');
            $input.innerHTML = $html;
            plugin_body.prepend($input);
        })
    }



    const parent_toggles = document.querySelectorAll('.toggle_switch');
    if(parent_toggles){
        parent_toggles.forEach(tg => {
            tg.addEventListener('click',() => {
                tg.classList.toggle('opened_switch');

                let parent = tg.parentElement;
                let accordeon = parent.nextElementSibling;
                accordeon.classList.toggle('closed_accordeon');

            })
        })
    }

})



document.addEventListener('DOMContentLoaded', function () {
    const textareas = document.querySelectorAll('textarea');

    if (typeof wp !== 'undefined' && wp.codeEditor) {
        textareas.forEach(textarea => {
            wp.codeEditor.initialize(textarea, {
                codemirror: {
                    mode: 'css',             
                    lineNumbers: false,      
                    matchBrackets: false,     
                    styleActiveLine: false,   
                    autoCloseBrackets: true   
                }
            });
        });
    }
});


