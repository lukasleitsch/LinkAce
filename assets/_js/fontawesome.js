import { dom, library } from '@fortawesome/fontawesome-svg-core';

import { faSave } from '@fortawesome/free-solid-svg-icons/faSave';
import { faFolder } from '@fortawesome/free-solid-svg-icons/faFolder';
import { faArchive } from '@fortawesome/free-solid-svg-icons/faArchive';
import { faBoxOpen } from '@fortawesome/free-solid-svg-icons/faBoxOpen';
import { faStickyNote } from '@fortawesome/free-solid-svg-icons/faStickyNote';
import { faSearch } from '@fortawesome/free-solid-svg-icons/faSearch';
import { faShareAlt } from '@fortawesome/free-solid-svg-icons/faShareAlt';
import { faUnlock } from '@fortawesome/free-solid-svg-icons/faUnlock';
import { faUser } from '@fortawesome/free-solid-svg-icons/faUser';

import { faGithub } from '@fortawesome/free-brands-svg-icons/faGithub';
import { faTwitter } from '@fortawesome/free-brands-svg-icons/faTwitter';

export function initFontAwesome () {
  library.add(faFolder);
  library.add(faSave);
  library.add(faArchive);
  library.add(faBoxOpen);
  library.add(faStickyNote);
  library.add(faSearch);
  library.add(faShareAlt);
  library.add(faUnlock);
  library.add(faUser);

  library.add(faGithub);
  library.add(faTwitter);

  dom.i2svg();
}

if (document.readyState !== 'loading') {
  initFontAwesome();
} else {
  document.addEventListener('DOMContentLoaded', initFontAwesome);
}
