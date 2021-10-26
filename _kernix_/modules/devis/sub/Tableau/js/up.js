var delai=0; var pix=0; var pixmax=0; var inc=0;

function MomNavigateur() {
  if (navigator.appName=="Microsoft Internet Explorer") {
	pixscroll = document.documentElement.scrollTop;
  }
  else {
	pixscroll = window.pageYOffset;
  }	
}

function ScrollUpToPage() {
	delai=1;
	inc=-20;
	MomNavigateur()
	pix = pixscroll;
	if (-inc > pixscroll) {
		if (pixscroll > 15) {inc = -pixmax+15;};
	}
	if (pixscroll > 15) {self.scrollTo(0,15);pixscroll=15;pix=15;inc=-5;}
	setTimeout("scroll()",delai);
}

function scroll() {
	pix=pix+inc;
	self.scrollBy(0,inc);
	if (pix >= 0) {
		setTimeout("scroll()",delai);
		MomNavigateur();
		if (pixscroll <= 5) {inc=-1;}
		if (pixscroll > 5) {if (pixscroll <= 10) {inc=-3;};}
		if (pix < pixscroll) {pix=0;};
	}
}
