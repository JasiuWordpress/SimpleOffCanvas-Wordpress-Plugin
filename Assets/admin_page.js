
document.addEventListener('DOMContentLoaded',(event) => {
   
    const add_new_btn = document.querySelector('.addmore');
    const plugin_body = document.querySelector('.simpleoffcanvas_parent');
    let $html = `<input type="text" name="simpleoffcanvas_class[]" placeholder="Write your's div class without a dot.">`;
    let no_divs_p = document.querySelector('.no_divs_p');

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
                    mode: 'css',              // lub 'javascript', 'htmlmixed', itd.
                    lineNumbers: false,       // wyłącz numerowanie
                    matchBrackets: false,     // wyłącz podświetlanie
                    styleActiveLine: false,   // wyłącz aktywną linię
                    autoCloseBrackets: true   // ✅ zostaje!
                }
            });
        });
    }
});


