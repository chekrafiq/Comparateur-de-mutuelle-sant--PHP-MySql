<?php

header("Content-type: application/pdf");
header("Content-Disposition: attachment; filename=file.pdf" ); 
header("Content-Description: PHP3 Generated Data" );


$pdf = pdf_open();
pdf_set_info($pdf, "Creator", "$g_softname");
pdf_set_info($pdf, "Author", "$g_softurl");
pdf_set_info($pdf, "Title", $ref->name);
pdf_set_info($pdf, "Subject", $ref->description);
pdf_begin_page($pdf, 595, 842);
pdf_add_outline($pdf, "Page 1");
pdf_set_font($pdf, "Helvetica-Bold", 30, "host");
pdf_set_value($pdf, "textrendering", 1);
pdf_show_xy($pdf, "$ref->name : ", 50, 750);
pdf_moveto($pdf, 50, 740);
pdf_lineto($pdf, 330, 740);
pdf_stroke($pdf);
pdf_set_font($pdf, "Helvetica", 10, "host");
pdf_show_xy($pdf, bdd2txt($ref->content), 100, 700); 
pdf_end_page($pdf);
pdf_close($pdf);

return 1;

?>
