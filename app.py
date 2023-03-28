from flask import Flask, render_template, make_response
import re
import PyPDF2
import json

app = Flask(__name__)

@app.route('/')
def index():
    # Open the PDF file in read-binary mode
    with open('pdfs\E-Statement.pdf', 'rb') as file:
        # Create a PDF reader object
        pdf_reader = PyPDF2.PdfReader(file)

        # Get the number of pages in the PDF file
        num_pages = len(pdf_reader.pages)

        # Loop through each page and extract the text
        for page_num in range(num_pages):
            if page_num < 2: # to print only page 1 and 2
                # Get the page object
                page_obj = pdf_reader.pages[page_num]

                # Extract the text from the page
                text = page_obj.extract_text()

                # Search for the required text
                match = re.search(r'Start balance\s*£\s*\d+,\d+\.\d+\s*Money in\s*£\s*\d+,\d+\.\d+\s*Money out\s*£\s*\d+,\d+\.\d+\s*End balance\s*£\s*\d+,\d+\.\d+', text)

                # Check if the text is found
                if match:
                    # Render the template with the matched text
                    response= make_response(render_template('index.html', balance=match.group()))

                    response.set_cookie('balance', match.group())

                    return response


    # If the text is not found, render the template with an error message
    return render_template('index.html', error='Cannot find the required text')

if __name__ == '__main__':
    app.run(debug=True)
