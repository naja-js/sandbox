import naja from 'naja';
import netteForms from 'nette-forms';

naja.formsHandler.netteForms = netteForms;
document.addEventListener('DOMContentLoaded', () => naja.initialize());
