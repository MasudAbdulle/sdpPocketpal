from flask import Flask, render_template, make_response, request
import re
import PyPDF2
import os

app = Flask(__name__)

@app.route('/', methods=['GET', 'POST'])
def index():
    if request.method == 'POST':
        # Check if the POST request has a file part
        if 'file' not in request.files:
            return render_template('index.html', error='No file selected')

        file = request.files['file']

        # Check if the file is a PDF
        if not file.filename.endswith('.pdf'):
            return render_template('index.html', error='Please select a PDF file')

        # Save the file to the server
        file_path = os.path.join(app.config['UPLOAD_FOLDER'], file.filename)
        file.save(file_path)

        # Open the PDF file in read-binary mode
        with open(file_path, 'rb') as file:
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

    # Render the index.html file with an empty form
    return render_template('index.html')

if __name__ == '__main__':
    app.config['UPLOAD_FOLDER'] = 'pdfs'
    app.run(debug=True)
