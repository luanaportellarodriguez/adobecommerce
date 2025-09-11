// script.js - Movimentação dinâmica corrigida
require(['jquery', 'domReady!'], function($) {
    'use strict';

    let isElementMoved = false;
    
    // Objetos separados para armazenar posições originais
    let minicartOriginal = {
        parent: null,
        nextSibling: null
    };
    
    let logoOriginal = {
        parent: null,
        nextSibling: null
    };

    // Função para mover elementos para o header
    function moveToHeader() {
        const minicart = $('.minicart-wrapper');
        const headerPanel = $('.header.panel');
        const topSearch = $('.block-search');
        const logo = $('.logo');

        if ((minicart.length || logo.length) && headerPanel.length && !isElementMoved) {
            
            // Salvar posições originais do minicart
            if (minicart.length) {
                minicartOriginal.parent = minicart.parent();
                minicartOriginal.nextSibling = minicart.next().length ? minicart.next() : null;
            }
            
            // Salvar posições originais da logo
            if (logo.length) {
                logoOriginal.parent = logo.parent();
                logoOriginal.nextSibling = logo.next().length ? logo.next() : null;
            }

            // Mover elementos
            if (topSearch.length) {
                if (logo.length) {
                    logo.insertAfter(topSearch);
                    logo.addClass('logo-header-panel');
                }
                if (minicart.length) {
                    minicart.insertAfter(logo.length ? logo : topSearch);
                    minicart.addClass('minicart-header-panel');
                }
            } else {
                // Se não encontrar o top.search, adiciona no final do header.panel
                if (logo.length) {
                    headerPanel.append(logo);
                    logo.addClass('logo-header-panel');
                }
                if (minicart.length) {
                    headerPanel.append(minicart);
                    minicart.addClass('minicart-header-panel');
                }
            }

            isElementMoved = true;
        }
    }

    // Função para restaurar posições originais
    function restoreOriginalPosition() {
        const minicart = $('.minicart-wrapper');
        const logo = $('.logo');

        if (isElementMoved) {
            // Restaurar minicart
            if (minicart.length && minicartOriginal.parent) {
                if (minicartOriginal.nextSibling) {
                    minicart.insertBefore(minicartOriginal.nextSibling);
                } else {
                    minicartOriginal.parent.append(minicart);
                }
                minicart.removeClass('minicart-header-panel');
            }
            

            if (logo.length && logoOriginal.parent) {
                if (logoOriginal.nextSibling) {
                    logo.insertBefore(logoOriginal.nextSibling);
                } else {
                    logoOriginal.parent.append(logo);
                }
                logo.removeClass('logo-header-panel');
            }

            isElementMoved = false;
        }
    }

    // Função principal para controlar o movimento baseado no scroll
    function handleScroll() {
        const scrollTop = $(window).scrollTop();
        const threshold = 100; // 100px de scroll

        if (scrollTop >= threshold && !isElementMoved) {
            moveToHeader();
        } else if (scrollTop < threshold && isElementMoved) {
            restoreOriginalPosition();
        }
    }

    // Event listener para scroll com throttle para performance
    let scrollTimer = null;
    $(window).on('scroll', function() {
        if (scrollTimer) {
            clearTimeout(scrollTimer);
        }
        
        scrollTimer = setTimeout(function() {
            handleScroll();
        }, 10); // Throttle de 10ms
    });

    $(document).on('click', '#toggle-theme-btn', function() {
        if ($('body').hasClass('black-background')) {
            $('body').removeClass('black-background').addClass('white-background');
        } else {
            $('body').removeClass('white-background').addClass('black-background');
        }
    });

    if ($(window).scrollTop() > 0) {
        $('html, body').animate({
            scrollTop: 0
        }, 1000); 
    }

    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }
});