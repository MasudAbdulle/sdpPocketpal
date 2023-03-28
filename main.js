import { PDFDocument, StandardFonts } from 'pdf-lib-master';


// Load a PDF file from a URL
const url = 'path/to/E-Statement.pdf';
const existingPdfBytes = await fetch(url).then(res => res.arrayBuffer());

// Load the PDF document
const pdfDoc = await PDFDocument.load(existingPdfBytes);

// Get the first page of the PDF
const pages = pdfDoc.getPages();
const firstPage = pages[0];

// Extract text from the page
const content = await firstPage.getTextContent();

// Print the text to the console
console.log(content.items.map(item => item.str).join(' '));
