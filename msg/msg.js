function abrir(params) {
    const x = document.getElementById('janela-modal')
    x.classList.add('abrirModal')

    x.addEventListener('click',(e) => {
        if(e.target.id == 'fechar' || e.target.id =='janela-modal' ){
            x.classList.remove('abrirModal')
        }
    })
}